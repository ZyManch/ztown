<?php

/**
 * This is the model class for table "topics".
 *
 * The followings are the available columns in table 'topics':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $user_id
 * @property string $content
 * @property integer $created
 */
class Topics extends ActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'topics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, content, created', 'required'),
			array('forum_id, user_id, created', 'numerical', 'integerOnly'=>true),
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