<?php

/**
 * This is the model class for table "army_names".
 *
 * The followings are the available columns in table 'army_names':
 * @property integer $id
 * @property string $type
 * @property integer $position
 * @property string $name
 */
class ArmyNames extends ActiveRecord {


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'army_names';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, position, name', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>8),
			array('name', 'length', 'max'=>16),

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