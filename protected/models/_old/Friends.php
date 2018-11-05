<?php

/**
 * This is the model class for table "friends".
 *
 * The followings are the available columns in table 'friends':
 * @property integer $id
 * @property integer $User1
 * @property integer $User2
 * @property integer $Confirm
 * @property string $Type
 * @property User $userTo
 * @property User $userFrom
 */
class Friends extends ActiveRecord {

    protected $_clone = null;


    public function behaviors() {
        return array(
            'friends' => array('class' => 'FriendsBehavior')
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'friends';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {

        return array(
            array('User1, User2', 'required'),
            array('User1, User2, Confirm', 'numerical', 'integerOnly'=> true),
            array('Type', 'length', 'max'=> 6),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'userFrom' => array(self::BELONGS_TO, 'User', 'User1'),
            'userTo'   => array(self::BELONGS_TO, 'User', 'User2'),
        );
    }

    /**
     * @return Friends
     */
    public function getClone() {
        if (is_null($this->_clone)) {
            $this->_clone = Friends::model()->findByAttributes(array(
                'User1' => $this->User2,
                'User2' => $this->User1,
                'Type'  => $this->Type
            ));
        }
        return $this->_clone;
    }

    /**
     * @return User
     */
    public function getFriend () {
        if ($this->User1 == \Yii::$app->user->getId()) {
            return $this->userTo;
        } else {
            return $this->userFrom;
        }
    }
}