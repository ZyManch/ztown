<?php

/**
 * This is the model class for table "items_buied".
 *
 * The followings are the available columns in table 'items_buied':
 * @property integer $id
 * @property integer $item_id
 * @property integer $user_id
 * @property integer $used
 * @property integer $level
 * @property string $light
 * @property integer $bonus1
 * @property integer $bonus2
 * @property integer $bonus3
 * @property integer $bonus4
 * @property integer $bonus5
 * @property integer $bonus6
 * @property Items $item
 * @property Stat $stat
 */
class ItemBuied extends ActiveRecord {

    const UPGRADE_STANDART = 'Standart';
    const UPGRADE_ADVANCED = 'Advansed';
    const UPGRADE_VIP      = 'Vip';
    const UPGRADE_GOLD     = 'Gold';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'item_buied';
	}

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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, user_id', 'required'),
			array('item_id, user_id, stat_id, used, level', 'numerical', 'integerOnly'=>true),
			array('light', 'length', 'max'=>8),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
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


    public function afterSave() {
        if ($this->used) {
            $profile = $this->user->itemsUsed();
            if ($profile[$this->item->type] && $profile[$this->item->type]->id != $this->id) {
                $profile[$this->item->type]->saveAttributes(array('used' => 0));
            }
        }
        $this->user->updateBonuses();
    }

	/**
	 * @return array relational rules.
	 */
    public function relations () {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'item' => array(self::BELONGS_TO, 'Items', 'item_id'),
            'stat' => array(self::BELONGS_TO, 'Stat', 'stat_id')
        );
    }

}