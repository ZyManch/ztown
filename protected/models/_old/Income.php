<?php

/**
 * This is the model class for table "income".
 *
 * The followings are the available columns in table 'income':
 * @property string $id
 * @property string $source_type
 * @property string $source_id
 * @property string $map_type_id
 * @property string $currency_id
 * @property string $income_type
 * @property integer $value
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property MapType $mapType
 * @property Currency $currency
 */
class Income extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Income the static model class
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
		return 'income';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_type, source_id, map_type_id, currency_id, value, changed', 'required'),
			array('value', 'numerical', 'integerOnly'=>true),
			array('source_type', 'length', 'max'=>6),
			array('source_id, map_type_id, currency_id', 'length', 'max'=>10),
			array('income_type', 'length', 'max'=>9),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, source_type, source_id, map_type_id, currency_id, income_type, value, status, changed', 'safe', 'on'=>'search'),
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
			'mapType' => array(self::BELONGS_TO, 'MapType', 'map_type_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);
	}

    public function assignToUser($userId, ActiveRecord $source) {
        $income = new UserIncome();
        $income->setAttributes(array(
             'user_id'       => $userId,
             'currency_id'   => $this->currency_id,
             'income_type'   => $this->income_type,
             'source_type'   => get_class($source),
             'source_id'     => $source->id,
             'value'         => $this->value
        ));
        $income->save();
    }

}