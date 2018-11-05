<?php

/**
 * This is the model class for table "moneys".
 *
 * The followings are the available columns in table 'moneys':
 * @property integer $id
 * @property integer $currency_id
 * @property integer $user_id
 * @property integer $value
 */
class Money extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'money';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('currency_id, user_id, value', 'required'),
            array('currency_id, user_id, value', 'numerical',
                'integerOnly'=> true),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

}