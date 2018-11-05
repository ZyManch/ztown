<?php

/**
 * This is the model class for table "mafiainfo".
 *
 * The followings are the available columns in table 'mafiainfo':
 * @property integer $id
 * @property integer $group_id
 * @property integer $map_id
 * @property integer $user_id
 * @property string $content
 */
class MafiaInfo extends ActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mafiainfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {

		return array(
			array('group_id, map_id, user_id', 'required'),
			array('group_id, map_id, user_id', 'numerical', 'integerOnly'=>true),
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