<?php

/**
 * This is the model class for table "user_animals".
 *
 * The followings are the available columns in table 'user_animals':
 * @property string $id
 * @property string $user_id
 * @property string $animal_id
 * @property string $level
 * @property string $exp
 * @property string $stat_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Stat $stat
 * @property User $user
 * @property Animals $animal
 */
class UserAnimal extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserAnimal the static model class
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
		return 'user_animals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, animal_id, stat_id', 'required'),
			array('user_id, animal_id, level, exp, stat_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			array('changed', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, animal_id, level, exp, stat_id, status, changed', 'safe', 'on'=>'search'),
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
			'stat' => array(self::BELONGS_TO, 'Stat', 'stat_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'animal' => array(self::BELONGS_TO, 'Animal', 'animal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'animal_id' => 'Animal',
			'level' => 'Level',
			'exp' => 'Exp',
			'stat_id' => 'Stat',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('animal_id',$this->animal_id,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('exp',$this->exp,true);
		$criteria->compare('stat_id',$this->stat_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}