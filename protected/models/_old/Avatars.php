<?php

/**
 * This is the model class for table "avatars".
 *
 * The followings are the available columns in table 'avatars':
 * @property string $id
 * @property string $filename
 * @property integer $position
 * @property string $status
 * @property string $changed
 */
class Avatars extends ActiveRecord {

    const AVATAR_PATH = '/images/avatars/';

    const AVATAR_WIDTH = 70;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Avatars the static model class
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
		return 'avatars';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, position, changed', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, filename, position, status, changed', 'safe', 'on'=>'search'),
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
			'filename' => 'Filename',
			'position' => 'Position',
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
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}