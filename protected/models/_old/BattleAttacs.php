<?php

/**
 * This is the model class for table "battles_attacs".
 *
 * The followings are the available columns in table 'battles_attacs':
 * @property integer $id
 * @property integer $battle_id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property integer $text
 * @property integer $power
 * @property user $fromUser
 * @property user $toUser
 * @property int $step
 */
class BattleAttacs extends ActiveRecord {


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'battles_attacs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('battle_id, step, text, power', 'required'),
			array('battle_id, step, from_user_id, to_user_id text, power', 'numerical', 'integerOnly'=>true),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'fromUser' => array(self::BELONGS_TO, 'User', 'from_user_id'),
            'toUser' => array(self::BELONGS_TO, 'User', 'to_user_id')
		);
	}


}