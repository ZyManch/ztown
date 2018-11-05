<?php

namespace models;

use Yii;

/**
 * This is the model class for table "item_buied".
 *
 * @property string $item_buied_id
 * @property string $item_id
 * @property string $user_id
 * @property string $stat_id
 * @property string $used
 * @property string $level
 * @property string $light
 * @property string $status
 * @property string $changed
 *
 * @property Item $item
 * @property Stat $stat
 * @property User $user
 */
class ItemBuied extends base\BaseItemBuied {

    const USED_YES = 'yes';
    const USED_NO = 'no';

    const UPGRADE_STANDART = 'Standart';
    const UPGRADE_ADVANCED = 'Advansed';
    const UPGRADE_VIP      = 'Vip';
    const UPGRADE_GOLD     = 'Gold';

    public static function labelUpgrade($type) {
        switch ($type) {
            case self::UPGRADE_STANDART:
                return 'Без апргрейда';
                break;
            case self::UPGRADE_ADVANCED:
                return 'Обычный апгрейд';
                break;
            case self::UPGRADE_VIP:
                return 'VIP апгрейд';
                break;
            case self::UPGRADE_GOLD:
                return 'Gold апгрейд';
                break;
        }
    }


    public function upgrade($type) {
        $this->light = $type;
        $this->level++;
        for($index=1; $index<=6; $index++) {
            switch($type) {
                case ItemBuied::UPGRADE_STANDART:
                    if($this->stat->getStat($index)){
                        $this->stat->addToBonus($index, rand(1, 2));
                    }
                    break;
                case ItemBuied::UPGRADE_ADVANCED:
                    if($index != 6) {
                        $this->stat->addToBonus($index, rand(1, 3));
                    }
                    break;
                case ItemBuied::UPGRADE_VIP:
                    if($this->stat->getStat($index)) {
                        $this->stat->addToBonus($index, rand(1, 4));
                    }else{
                        if(rand(1, 10)>7){
                            $this->stat->addToBonus($index, rand(1, 3));
                        }
                    }
                    break;
                case ItemBuied::UPGRADE_GOLD:
                    $this->stat->addToBonus($index, rand(1, 4));
                    break;
            }
        }
        $this->stat->save();
    }


    public function afterSave($insert, $changedAttributes) {
        if ($this->used) {
            $profile = $this->user->itemsUsed();
            if ($profile[$this->item->type] && $profile[$this->item->type]->id != $this->id) {
                $profile[$this->item->type]->saveAttributes(array('used' => 0));
            }
        }
        $this->user->updateBonuses();
        return parent::afterSave($insert, $changedAttributes);
    }

}