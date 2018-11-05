<?php

namespace models;

use Yii;

/**
 * This is the model class for table "battle_prize".
 *
 * @property string $battle_prize_id
 * @property string $battle_id
 * @property string $user_id
 * @property string $prize_id
 * @property string $prize_type
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property Battle $battle
 * @property User $user
 */
class BattlePrize extends base\BaseBattlePrize {

    const PRIZE_TYPE_MONEY = 'money';
    const PRIZE_TYPE_EXP = 'exp';
    const PRIZE_TYPE_ROOF = 'roof';


    /**
     * @return string
     */
    public function __toString() {
        switch ($this->prize_type) {
            case self::PRIZE_TYPE_EXP:
                return '<b>' . $this->value . '</b> опыта';
            case self::PRIZE_TYPE_MONEY:
                return \Yii::$app->view->render(
                    '//users/_money',
                    [
                        'money' => $this->value,
                        'currencyId' => $this->prize_id
                    ]
                );
            case self::PRIZE_TYPE_ROOF:
                $map = $this->map;
                $mapType = $map->mapType;
                return 'возможность крышевать ' . $this->map->getLink();
            default:
                return 'неизвестный приз';
        }
    }

    public function appendPrize() {
        switch ($this->prize_type) {
            case self::PRIZE_TYPE_EXP:
                $this->user->addExp($this->value);
                break;
            case self::PRIZE_TYPE_MONEY:
                $this->user->changeMoney($this->value, false, $this->prize_id);
                break;
            case self::PRIZE_TYPE_ROOF:

                break;
        }
    }

}