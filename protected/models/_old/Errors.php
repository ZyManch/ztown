<?php

/**
 * This is the model class for table "errors".
 *
 * The followings are the available columns in table 'errors':
 * @property integer $id
 * @property integer $userid
 * @property string $page
 * @property string $content
 */
class Errors extends ActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'errors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, page, content', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('page', 'length', 'max'=>64),
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