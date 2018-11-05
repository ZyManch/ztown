<?php

namespace models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property string $message_id
 * @property string $user_first_id
 * @property string $user_second_id
 * @property string $title
 * @property string $content
 * @property string $created
 * @property string $readed
 * @property string $status
 * @property string $changed
 *
 * @property User $userFirst
 * @property User $userSecond
 */
class Message extends base\BaseMessage {

    protected static $root = null;


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
}