<?php

/**
 * This is the model class for table "items_opened".
 *
 * The followings are the available columns in table 'items_opened':
 * @property integer $id
 * @property integer $user_id
 * @property integer $item_id
 */
class ItemOpened extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'item_opened';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        return array(
            array('user_id, item_id', 'required'),
            array('user_id, item_id', 'numerical', 'integerOnly'=> true),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'item' => array(self::BELONGS_TO, 'Item', 'item_id')
        );
    }

}