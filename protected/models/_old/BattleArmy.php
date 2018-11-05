<?php

/**
 * This is the model class for table "battles_army".
 *
 * The followings are the available columns in table 'battles_army':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $battle_id
 * @property integer $stat
 */
class BattleArmy extends ActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'battles_army';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, parent_id, battle_id, stat', 'required'),
			array('parent_id, battle_id, stat', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>33),
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