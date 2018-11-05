<?php

/**
 * This is the model class for table "price".
 *
 * The followings are the available columns in table 'price':
 * @property string $id
 * @property string $object_type
 * @property string $object_id
 * @property string $currency_id
 * @property integer $value
 * @property string $status
 * @property string $changed
 * @property Valuta $currency
 */
class Price extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Price the static model class
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
		return 'price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_type, object_id, currency_id, value, changed', 'required'),
			array('value', 'numerical', 'integerOnly'=>true),
			array('object_type', 'length', 'max'=>5),
			array('object_id, currency_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, object_type, object_id, currency_id, value, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
            'currency' => array(self::BELONGS_TO, 'Valuta', 'currency_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'object_type' => 'Object Type',
			'object_id' => 'Object',
			'currency_id' => 'Valuta',
			'value' => 'Value',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

    public function addToUser(User $user, $markUp = 1) {
        $user->changeMoney($markUp * $this->value, false, $this->currency_id);
    }

    public function removeFromUser(User $user, $markUp = 1) {
        $user->changeMoney(- $markUp * $this->value, false, $this->currency_id);
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
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('object_id',$this->object_id,true);
		$criteria->compare('currency_id',$this->currency_id,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}