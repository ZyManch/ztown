<?php

/**
 * This is the model class for table "battles".
 *
 * The followings are the available columns in table 'battles':
 * @property integer $id
 * @property string $win_side
 * @property string $hash
 * @property array $userstats
 * @property array $attacks
 * @property BattleUser $userLeft
 * @property BattleUser[] $usersLeft
 * @property BattleUser $userRight
 * @property BattleUser[] $usersRight
 * @property BattlePrize[] $prizes
 */
class Battles extends ActiveRecord {

    const SIDE_LEFT = 'left';
    const SIDE_RIGHT = 'right';

    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'battles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        return array(
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
            array('win_side, hash', 'length', 'max' => 6),
        );
    }

    public function beforeSave () {
        if (!$this->hash) {
            $this->hash = strtolower(substr(md5(rand(0, time())), 0, 6));
        }
        return parent::beforeSave();
    }

    /**
     * @param User $userLeft
     * @param User $userRight
     * @param array $prizes
     * @return bool
     */
    public function fight (User $userLeft, User $userRight, $prizes = array()) {
        if (($this->isNewRecord && !$this->save()) || $this->win_side) {
            return false;
        }
        // сохраняем статы того, кто дрался
        $battleUserLeft = BattleUser::getFromUser($userLeft, $this->id);
        $battleUserRight = BattleUser::getFromUser($userRight, $this->id);
        $battleUserLeft->side = Battles::SIDE_LEFT;
        $battleUserRight->side = Battles::SIDE_RIGHT;
        $battleUserLeft->save();
        $battleUserRight->save();
        // начинаем битву
        $userLeft->hp = Config::getHp($battleUserLeft->stat->getSumm(Items::STAT_HP));
        $userRight->hp = Config::getHp($battleUserRight->stat->getSumm(Items::STAT_HP));
        $chanceFromLeft = Config::getChanceHit(
            $battleUserLeft->stat->getSumm(Items::STAT_AGL), $battleUserRight->stat->getSumm(Items::STAT_AGL)
        );
        $chanceFromRight = Config::getChanceHit(
            $battleUserRight->stat->getSumm(Items::STAT_AGL), $battleUserLeft->stat->getSumm(Items::STAT_AGL)
        );
        $kritFromLeft = Config::getChanceKrit(
            $battleUserLeft->stat->getSumm(Items::STAT_AGL), $battleUserRight->stat->getSumm(Items::STAT_AGL)
        );
        $kritFromRight = Config::getChanceHit(
            $battleUserRight->stat->getSumm(Items::STAT_AGL), $battleUserLeft->stat->getSumm(Items::STAT_AGL)
        );
        $step = 0;
        while (($userLeft->hp > 0) && ($userRight->hp > 0)) {
            $this->_fight($step, $chanceFromLeft, $kritFromLeft, $userLeft, $userRight);
            $this->_fight($step, $chanceFromRight, $kritFromRight, $userRight, $userLeft);
            $step++;
        }
        if ($userLeft->hp < $userRight->hp) {
            $this->win_side = self::SIDE_RIGHT;
            $winUser = $userRight;
        } else {
            $this->win_side = self::SIDE_LEFT;
            $winUser = $userLeft;
        }
        foreach ($prizes as $prize) {
            /** @var BattlePrize $prize */
            $prize->user_id = $winUser->id;
            $prize->battle_id = $this->id;
            $prize->save();
        }
        $userLeft->setViewPage($this->getUrl(), UserViewPage::COUNT_ONE);
        $userRight->setViewPage($this->getUrl(), UserViewPage::COUNT_ONE);
        $this->save();
        return true;
    }

    function _fight ($step, $chanseHit, $chanseKrit, User $userLeft, User $userRight) {
        $battleAttack = new BattleAttacs();
        $battleAttack->setAttributes(array(
            'battle_id'    => $this->id,
            'from_user_id' => $userLeft->id,
            'to_user_id'   => $userRight->id,
            'step'         => $step
        ));
        if (rand(0, 100) < 100 * $chanseHit) {
            // если попал
            $damage = Config::getDamage(
                $userLeft->stat->getSumm(Items::STAT_ATC), $userRight->stat->getSumm(Items::STAT_DEF)
            );
            if (rand(0, 100) < 100 * $chanseKrit) {
                // если крит
                $damage *= 2;
                $userRight->hp -= $damage;
                $battleAttack->setAttributes(array(
                    'text'  => rand(20, 29),
                    'power' => $damage
                ));

            } else {
                //если не крит
                $userRight->hp -= $damage;
                $battleAttack->setAttributes(array(
                    'text'  => rand(0, 9),
                    'power' => $damage
                ));
            }
        } else {
            // если мимо
            $battleAttack->setAttributes(array(
                'text'  => rand(10, 19),
                'power' => 0
            ));
        }
        $battleAttack->save();
    }

    public function getUrl() {
        return CHtml::normalizeUrl(array(
            'battles/view', 'id' => $this->id, 'hash'=>$this->hash
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'usersLeft'  => array(self::HAS_MANY, 'BattleUser', 'battle_id', 'on' => 'usersLeft.side="left"'),
            'usersRight' => array(self::HAS_MANY, 'BattleUser', 'battle_id', 'on' => 'usersRight.side="right"'),
            'userLeft'  => array(self::HAS_ONE, 'BattleUser', 'battle_id', 'on' => 'userLeft.side="left"'),
            'userRight' => array(self::HAS_ONE, 'BattleUser', 'battle_id', 'on' => 'userRight.side="right"'),
            'userstats' => array(self::HAS_MANY, 'BattleUser', 'battle_id'),
            'attacks' => array(self::HAS_MANY, 'BattleAttacs', 'battle_id', 'order' => 'attacks.step ASC, attacks.id ASC'),
            'prizes' => array(self::HAS_MANY, 'BattlePrize', 'battle_id', 'order' => 'prizes.prize_type ASC'),
        );
    }

}