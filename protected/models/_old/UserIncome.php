<?php

use components\Date;

/**
 * This is the model class for table "user_income".
 *
 * The followings are the available columns in table 'user_income':
 * @property string $id
 * @property string $user_id
 * @property string $currency_id
 * @property string $source_type
 * @property string $source_id
 * @property string $income_type
 * @property integer $value
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Currency $currency
 */
class UserIncome extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserIncome the static model class
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
		return 'user_income';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, currency_id, value', 'required'),
			array('value', 'numerical', 'integerOnly'=>true),
			array('user_id, currency_id, source_id', 'length', 'max'=>10),
			array('source_type', 'length', 'max'=>10),
			array('income_type', 'length', 'max'=>9),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, currency_id, source_type, source_id, income_type, value, status, changed', 'safe', 'on'=>'search'),
		);
	}

    public function getMoney() {
        $timestamp = strtotime($this->changed);
        return round (
            $this->value *
            (\components\Date::timestamp() - \components\Date::timestamp($timestamp)) /
            3600
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
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);
	}

    public function getSecondsToUserIncome() {
        $date = explode(':', date('H:i:s', \components\Date::timestamp()));
        $seconds = $this->Time - $date[0]*3600 - $date[1]*60-$date[2];
        if ($seconds < 0) {
            $seconds += 86400;
        }
        return $seconds;
    }

    public static function getSeconds($time=null) {
        if (is_null($time)) {
            $time = Date::timestamp();
        }
        $date = explode(':', date('H:i:s', $time));
        return $seconds = $date[0]*3600 + $date[1]*60 + $date[2];
    }
}