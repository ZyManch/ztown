<?php

/**
 * This is the model class for table "houses".
 *
 * The followings are the available columns in table 'houses':
 * @property integer $id
 * @property integer $user_id
 * @property integer $map_id
 * @property User $user
 * @property Map $map
 */
class Houses extends ActiveRecord{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'houses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('map_id', 'required'),
			array('user_id, map_id', 'numerical', 'integerOnly'=>true),

            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array_merge(
            parent::relations(),
		    array(
                'user'   => array(self::BELONGS_TO, 'User', 'user_id'),
                'map'    => array(self::BELONGS_TO, 'Map', 'map_id'),
            )
        );
	}

}