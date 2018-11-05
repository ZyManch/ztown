<?php

/**
 * This is the model class for table "reports".
 *
 * The followings are the available columns in table 'reports':
 * @property integer $id
 * @property string $title
 * @property integer $user_first_id
 * @property integer $user_second_id
 * @property integer $Date
 * @property integer $Money
 */
class Reports extends ActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, user_second_id, Date, Money', 'required'),
			array('user_first_id, user_second_id, Date, Money', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>16),
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
            'fromUser' => array(self::BELONGS_TO, 'User', 'user_first_id'),
            'toUser'   => array(self::BELONGS_TO, 'User', 'user_second_id')
		);
	}

}