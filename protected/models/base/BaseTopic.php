<?php

namespace models\base;



/**
 * This is the model class for table "city.topic".
 *
 * @property string $topic_id
 * @property string $user_id
 * @property string $forum_id
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property \models\Forum $forum
 * @property \models\User $user
 */
class BaseTopic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseTopicPeer::USER_ID, BaseTopicPeer::FORUM_ID], 'integer'],
            [[BaseTopicPeer::CONTENT], 'required'],
            [[BaseTopicPeer::CONTENT, BaseTopicPeer::STATUS], 'string'],
            [[BaseTopicPeer::CHANGED], 'safe'],
            [[BaseTopicPeer::FORUM_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseForum::className(), 'targetAttribute' => [BaseTopicPeer::FORUM_ID => BaseForumPeer::FORUM_ID]],
            [[BaseTopicPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseTopicPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseTopicPeer::TOPIC_ID => 'Topic ID',
            BaseTopicPeer::USER_ID => 'User ID',
            BaseTopicPeer::FORUM_ID => 'Forum ID',
            BaseTopicPeer::CONTENT => 'Content',
            BaseTopicPeer::STATUS => 'Status',
            BaseTopicPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\ForumQuery
     */
    public function getForum() {
        return $this->hasOne(\models\Forum::className(), [BaseForumPeer::FORUM_ID => BaseTopicPeer::FORUM_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseTopicPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\TopicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\TopicQuery(get_called_class());
    }
}
