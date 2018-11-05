<?php

namespace models\base;



/**
 * This is the model class for table "city.forum".
 *
 * @property string $forum_id
 * @property string $parent_id
 * @property string $title
 * @property string $user_id
 * @property string $group_id
 * @property string $updated
 * @property string $visibled
 * @property string $enabled
 * @property string $is_topic
 * @property string $position
 * @property string $topics
 * @property string $status
 * @property string $changed
 *
 * @property \models\Group $group
 * @property \models\Forum $parent
 * @property \models\Forum[] $forums
 * @property \models\User $user
 * @property \models\Topic[] $topics0
 */
class BaseForum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.forum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseForumPeer::PARENT_ID, BaseForumPeer::TITLE, BaseForumPeer::USER_ID, BaseForumPeer::GROUP_ID, BaseForumPeer::UPDATED, BaseForumPeer::POSITION, BaseForumPeer::TOPICS], 'required'],
            [[BaseForumPeer::PARENT_ID, BaseForumPeer::USER_ID, BaseForumPeer::GROUP_ID, BaseForumPeer::UPDATED, BaseForumPeer::POSITION, BaseForumPeer::TOPICS], 'integer'],
            [[BaseForumPeer::VISIBLED, BaseForumPeer::ENABLED, BaseForumPeer::IS_TOPIC, BaseForumPeer::STATUS], 'string'],
            [[BaseForumPeer::CHANGED], 'safe'],
            [[BaseForumPeer::TITLE], 'string', 'max' => 64],
            [[BaseForumPeer::GROUP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseGroup::className(), 'targetAttribute' => [BaseForumPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]],
            [[BaseForumPeer::PARENT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseForum::className(), 'targetAttribute' => [BaseForumPeer::PARENT_ID => BaseForumPeer::FORUM_ID]],
            [[BaseForumPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseForumPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseForumPeer::FORUM_ID => 'Forum ID',
            BaseForumPeer::PARENT_ID => 'Parent ID',
            BaseForumPeer::TITLE => 'Title',
            BaseForumPeer::USER_ID => 'User ID',
            BaseForumPeer::GROUP_ID => 'Group ID',
            BaseForumPeer::UPDATED => 'Updated',
            BaseForumPeer::VISIBLED => 'Visibled',
            BaseForumPeer::ENABLED => 'Enabled',
            BaseForumPeer::IS_TOPIC => 'Is Topic',
            BaseForumPeer::POSITION => 'Position',
            BaseForumPeer::TOPICS => 'Topics',
            BaseForumPeer::STATUS => 'Status',
            BaseForumPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\GroupQuery
     */
    public function getGroup() {
        return $this->hasOne(\models\Group::className(), [BaseGroupPeer::GROUP_ID => BaseForumPeer::GROUP_ID]);
    }
        /**
     * @return \models\ForumQuery
     */
    public function getParent() {
        return $this->hasOne(\models\Forum::className(), [BaseForumPeer::FORUM_ID => BaseForumPeer::PARENT_ID]);
    }
        /**
     * @return \models\ForumQuery
     */
    public function getForums() {
        return $this->hasMany(\models\Forum::className(), [BaseForumPeer::PARENT_ID => BaseForumPeer::FORUM_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseForumPeer::USER_ID]);
    }
        /**
     * @return \models\TopicQuery
     */
    public function getTopics0() {
        return $this->hasMany(\models\Topic::className(), [BaseTopicPeer::FORUM_ID => BaseForumPeer::FORUM_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ForumQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ForumQuery(get_called_class());
    }
}
