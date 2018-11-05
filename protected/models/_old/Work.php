<?php

/**
 * This is the model class for table "works".
 *
 * The followings are the available columns in table 'works':
 * @property string $id
 * @property integer $map_type_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property integer $price_id
 * @property WorkBonus $workBonus
 */
class Work extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Work the static model class
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
		return 'works';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('map_type_id, title, description', 'required'),
			array('map_type_id, price_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('image', 'length', 'max'=>32),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, map_type_id, title, image, description, price_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		return array_merge(
            parent::relations(),
            array(
                'workBonus' => array(self::HAS_ONE,'WorkBonus','work_id')
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
			'map_type_id' => 'Map Type',
			'title' => 'Title',
			'image' => 'Image',
			'description' => 'Description',
			'price_id' => 'Price',
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
		$criteria->compare('map_type_id',$this->map_type_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price_id',$this->price_id);
		$criteria->compare('add_sub_levels',$this->add_sub_levels);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}