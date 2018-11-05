<?php

/**
 * This is the model class for table "forum".
 *
 * The followings are the available columns in table 'forum':
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $group_id
 * @property integer $visibled
 * @property integer $enabled
 * @property integer $is_topics
 * @property integer $position
 * @property integer $topics
 * @property integer $updated
 */
class Forum extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'forum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, parent_id, user_id, group_id, updated', 'required'),
			array('parent_id, user_id, group_id, visibled, enabled, is_topics, position, topics, updated', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>32),
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