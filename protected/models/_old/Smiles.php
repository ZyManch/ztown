<?php

/**
 * This is the model class for table "smiles".
 *
 * The followings are the available columns in table 'smiles':
 * @property integer $id
 * @property string $file
 * @property string $bbcode
 * @property integer $visible
 */
class Smiles extends ActiveRecord {


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'smiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file, bbcode', 'required'),
			array('visible', 'numerical', 'integerOnly'=>true),
			array('file, bbcode', 'length', 'max'=>16),
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