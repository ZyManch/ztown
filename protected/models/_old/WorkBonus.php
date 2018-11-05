<?php

/**
 * This is the model class for table "work_bonus".
 *
 * The followings are the available columns in table 'work_bonus':
 * @property string $id
 * @property string $work_id
 * @property integer $add_sub_levels
 */
class WorkBonus extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkBonus the static model class
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
		return 'work_bonus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('work_id', 'required'),
			array('add_sub_levels', 'numerical', 'integerOnly'=>true),
			array('work_id', 'length', 'max'=>10),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, work_id, add_sub_levels', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array_merge(
            parent::relations(),
            array()
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'work_id' => 'Work',
			'add_sub_levels' => 'Add Sub Levels',
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
		$criteria->compare('work_id',$this->work_id,true);
		$criteria->compare('add_sub_levels',$this->add_sub_levels);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}