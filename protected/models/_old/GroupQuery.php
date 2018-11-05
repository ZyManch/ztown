<?php

/**
 * This is the model class for table "groupquery".
 *
 * The followings are the available columns in table 'groupquery':
 * @property integer $id
 * @property integer $autor_id
 * @property integer $user_id
 * @property integer $group_id
 * @property integer $date
 */
class GroupQuery extends ActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'groupquery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('autor_id, user_id, group_id, date', 'required'),
			array('autor_id, user_id, group_id, date', 'numerical', 'integerOnly'=>true),
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
		);
	}

}