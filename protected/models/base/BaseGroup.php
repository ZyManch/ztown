<?php

namespace models\base;



/**
 * This is the model class for table "city.group".
 *
 * @property string $group_id
 * @property string $name
 * @property string $lower_name
 * @property string $mens
 * @property string $taked
 * @property string $balls
 * @property string $can_take
 * @property string $type
 * @property string $status
 * @property string $changed
 *
 * @property \models\Forum[] $forums
 * @property \models\GroupQuery[] $groupQueries
 * @property \models\MafiaInfo[] $mafiaInfos
 * @property \models\User[] $users
 */
class BaseGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseGroupPeer::NAME, BaseGroupPeer::LOWER_NAME, BaseGroupPeer::MENS, BaseGroupPeer::TAKED, BaseGroupPeer::BALLS, BaseGroupPeer::CAN_TAKE], 'required'],
            [[BaseGroupPeer::MENS, BaseGroupPeer::TAKED, BaseGroupPeer::BALLS, BaseGroupPeer::CAN_TAKE], 'integer'],
            [[BaseGroupPeer::TYPE, BaseGroupPeer::STATUS], 'string'],
            [[BaseGroupPeer::CHANGED], 'safe'],
            [[BaseGroupPeer::NAME, BaseGroupPeer::LOWER_NAME], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseGroupPeer::GROUP_ID => 'Group ID',
            BaseGroupPeer::NAME => 'Name',
            BaseGroupPeer::LOWER_NAME => 'Lower Name',
            BaseGroupPeer::MENS => 'Mens',
            BaseGroupPeer::TAKED => 'Taked',
            BaseGroupPeer::BALLS => 'Balls',
            BaseGroupPeer::CAN_TAKE => 'Can Take',
            BaseGroupPeer::TYPE => 'Type',
            BaseGroupPeer::STATUS => 'Status',
            BaseGroupPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\ForumQuery
     */
    public function getForums() {
        return $this->hasMany(\models\Forum::className(), [BaseForumPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]);
    }
        /**
     * @return \models\GroupQueryQuery
     */
    public function getGroupQueries() {
        return $this->hasMany(\models\GroupQuery::className(), [BaseGroupQueryPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]);
    }
        /**
     * @return \models\MafiaInfoQuery
     */
    public function getMafiaInfos() {
        return $this->hasMany(\models\MafiaInfo::className(), [BaseMafiaInfoPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUsers() {
        return $this->hasMany(\models\User::className(), [BaseUserPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\GroupQuery(get_called_class());
    }
}
