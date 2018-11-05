<?php

/**
 * This is the model class for table "animals".
 *
 * The followings are the available columns in table 'animals':
 * @property string $id
 * @property string $type
 * @property string $name
 * @property string $content
 * @property integer $level
 * @property integer $stat_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property UserAnimal[] $userAnimals
 */
class Animal extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Animal the static model class
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
		return 'animals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, changed', 'required'),
			array('level, stat_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('type', 'length', 'max'=>5),
			array('status', 'length', 'max'=>7),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
        return array_merge(
            parent::relations(),
            array(
                'userAnimals' => array(self::HAS_MANY, 'UserAnimal', 'animal_id'),
            )
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'name' => 'Name',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function image() {
        return 'images/animals/'.$this->type.$this->id.'.png';
    }
}