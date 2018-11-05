<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property integer $user_first_id
 * @property integer $user_second_id
 * @property string $title
 * @property string $content
 * @property integer $created
 * @property string $readed
 * @property User $fromUser
 * @property User $toUser
 */
class Messages extends ActiveRecord {

    protected static $root = null;

    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'messages';
    }

    public static function sendMessage($title, $content, User $toUser,
        $fromUser = null, $autoShow = false
    ) {
        if (is_null($fromUser)) {
            if (is_null(self::$root)) {
                self::$root = User::model()->findByAttributes(array('access'=> 'Admin'));
            }
            $fromUser = self::$root;
        }
        $message = new Messages();
        $message->setAttributes(array(
            'title' => $title,
            'content' => $content,
            'user_first_id' => $fromUser->id,
            'user_second_id' => $toUser->id,
            'created' => time()
        ));
        $message->save();
        if ($autoShow) {
            $toUser->setViewPage(CHtml::normalizeUrl(array('messages/view', 'id' => $message->id)));
        }
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        return array(
            array('user_first_id, user_second_id, title, created', 'required'),
            array('user_first_id, user_second_id, created', 'numerical',
                'integerOnly'=> true),
            array('title', 'length', 'max'=> 32),
            array('readed', 'length', 'max'=> 1),
            array('content', 'safe'),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'fromUser' => array(self::BELONGS_TO, 'User', 'user_first_id'),
            'toUser'   => array(self::BELONGS_TO, 'User', 'user_second_id'),
        );
    }

}