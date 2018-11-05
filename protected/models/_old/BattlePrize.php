<?php

/**
 * This is the model class for table "battles_prize".
 *
 * The followings are the available columns in table 'battles_prize':
 * @property string $id
 * @property string $battle_id
 * @property string $user_id
 * @property string $prize_type
 * @property string $prize_id
 * @property integer $value
 * @property string $status
 * @property string $changed
 * @property Currency $currency
 * @property Map $map
 * @property User $user
 */
class BattlePrize extends ActiveRecord {
    const PRIZE_TYPE_MONEY = 'money';
    const PRIZE_TYPE_EXP = 'exp';
    const PRIZE_TYPE_ROOF = 'roof';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BattlePrize the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'battles_prize';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('battle_id, user_id, prize_type', 'required'),
			array('value', 'numerical', 'integerOnly'=>true),
			array('battle_id, user_id, prize_id', 'length', 'max'=>10),
			array('prize_type', 'length', 'max'=>5),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, battle_id, user_id, prize_type, prize_id, value, status, changed', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors() {
        return array(
            'appendPrize' => array(
                'class'=>'BattlePrizeBehavior',
            )
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'currency' => array(self::BELONGS_TO, 'Currency', 'prize_id'),
            'map' => array(self::BELONGS_TO, 'Map', 'prize_id', 'with' => 'mapType'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'battle_id' => 'Battle',
			'user_id' => 'User',
			'prize_type' => 'Prize Type',
			'prize_id' => 'Prize',
			'value' => 'Value',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('battle_id',$this->battle_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('prize_type',$this->prize_type,true);
		$criteria->compare('prize_id',$this->prize_id,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function __toString() {
        switch ($this->prize_type) {
            case self::PRIZE_TYPE_EXP:
                return '<b>' . $this->value . '</b> опыта';
            case self::PRIZE_TYPE_MONEY:
                return \Yii::$app->controller->renderPartial(
                    '//users/_money',
                    array(
                         'money' => $this->value,
                         'currencyId' => $this->prize_id
                    ),
                    true
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