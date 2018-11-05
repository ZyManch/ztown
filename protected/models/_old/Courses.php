<?php

/**
 * This is the model class for table "courses".
 *
 * The followings are the available columns in table 'courses':
 * @property integer $id
 * @property integer $currency_id
 * @property float $price
 * @property string $changed
 */
class Courses extends ActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('currency_id', 'required'),
			array('currency_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7)
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