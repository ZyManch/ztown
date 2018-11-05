<?php

/**
 * This is the model class for table "map_works".
 *
 * The followings are the available columns in table 'map_works':
 * @property string $id
 * @property string $map_id
 * @property string $work_id
 * @property int $count
 *
 * The followings are the available model relations:
 * @property Work $work
 * @property Map $map
 */
class MapWork extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MapWork the static model class
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
		return 'map_works';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('map_id, work_id, count', 'required'),
			array('map_id, work_id', 'length', 'max'=>10),
			array('count', 'numerical'),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, map_id, work_id', 'safe', 'on'=>'search'),
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
			'work' => array(self::BELONGS_TO, 'Work', 'work_id'),
			'map' => array(self::BELONGS_TO, 'Map', 'map_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'map_id' => 'Map',
			'work_id' => 'Work',
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
		$criteria->compare('map_id',$this->map_id,true);
		$criteria->compare('work_id',$this->work_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}