<?php

/**
 * This is the model class for table "streets".
 *
 * The followings are the available columns in table 'streets':
 * @property string $id
 * @property string $name
 * @property integer $left_x
 * @property integer $right_x
 * @property integer $top_y
 * @property integer $bottom_y
 * @property string $status
 * @property string $Active
 */
class Street extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Street the static model class
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
		return 'streets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, left_x, right_x, top_y, bottom_y, Active', 'required'),
			array('left_x, right_x, top_y, bottom_y', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, left_x, right_x, top_y, bottom_y, status, Active', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'left_x' => 'Left X',
			'right_x' => 'Right X',
			'top_y' => 'Top Y',
			'bottom_y' => 'Bottom Y',
			'status' => 'Status',
			'Active' => 'Active',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('left_x',$this->left_x);
		$criteria->compare('right_x',$this->right_x);
		$criteria->compare('top_y',$this->top_y);
		$criteria->compare('bottom_y',$this->bottom_y);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('Active',$this->Active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}