<?php

/**
 * This is the model class for table "arena".
 *
 * The followings are the available columns in table 'arena':
 * @property integer $id
 * @property integer $user_id
 * @property integer $lvl
 * @property User $user
 */
class Arena extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Arena the static model class
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
		return 'arena';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, lvl', 'required'),
			array('user_id, lvl', 'numerical', 'integerOnly'=>true),

            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id')
		);
	}
}