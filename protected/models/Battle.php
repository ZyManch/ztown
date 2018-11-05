<?php

namespace models;

use components\Config;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "battle".
 *
 * @property string $battle_id
 * @property string $win_side
 * @property string $hash
 * @property string $status
 * @property string $changed
 *
 * @property BattleArmy[] $battleArmies
 * @property BattleAttack[] $battleAttacks
 * @property BattlePrize[] $battlePrizes
 * @property BattleUser[] $battleUsers
 */
class Battle extends base\BaseBattle {
    
    const SIDE_LEFT = 'left';
    const SIDE_RIGHT = 'right';


    public function beforeSave ($insert) {
        if (!$this->hash) {
            $this->hash = strtolower(substr(md5(rand(0, time())), 0, 6));
        }
        return parent::beforeSave($insert);
    }

    /**
     * @param User $userLeft
     * @param User $userRight
     * @param array $prizes
     * @return bool
     */
    public function fight (User $userLeft, User $userRight, $prizes = array()) {
        if ($this->win_side || ($this->isNewRecord && !$this->save())) {
            return false;
        }
        // сохраняем статы того, кто дрался
        $battleUserLeft = BattleUser::getFromUser($userLeft, $this->id);
        $battleUserRight = BattleUser::getFromUser($userRight, $this->id);
        $battleUserLeft->side = self::SIDE_LEFT;
        $battleUserRight->side = self::SIDE_RIGHT;
        $battleUserLeft->save();
        $battleUserRight->save();
        // начинаем битву
        $userLeft->hp = Config::getHp($battleUserLeft->stat->getSumm(Item::STAT_HP));
        $userRight->hp = Config::getHp($battleUserRight->stat->getSumm(Item::STAT_HP));
        $chanceFromLeft = Config::getChanceHit(
            $battleUserLeft->stat->getSumm(Item::STAT_AGL), $battleUserRight->stat->getSumm(Item::STAT_AGL)
        );
        $chanceFromRight = Config::getChanceHit(
            $battleUserRight->stat->getSumm(Item::STAT_AGL), $battleUserLeft->stat->getSumm(Item::STAT_AGL)
        );
        $kritFromLeft = Config::getChanceKrit(
            $battleUserLeft->stat->getSumm(Item::STAT_AGL), $battleUserRight->stat->getSumm(Item::STAT_AGL)
        );
        $kritFromRight = Config::getChanceHit(
            $battleUserRight->stat->getSumm(Item::STAT_AGL), $battleUserLeft->stat->getSumm(Item::STAT_AGL)
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

    protected function _fight ($step, $chanseHit, $chanseKrit, User $userLeft, User $userRight) {
        $battleAttack = new BattleAttack();
        $battleAttack->setAttributes(array(
             'battle_id'    => $this->id,
             'from_user_id' => $userLeft->id,
             'to_user_id'   => $userRight->id,
             'step'         => $step
        ));
        if (rand(0, 100) < 100 * $chanseHit) {
            // если попал
            $damage = Config::getDamage(
                $userLeft->stat->getSumm(Item::STAT_ATC), $userRight->stat->getSumm(Item::STAT_DEF)
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
        return Url::to(array(
           'battles/view', 'id' => $this->battle_id, 'hash'=>$this->hash
        ));
    }
}