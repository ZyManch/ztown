<?php

namespace models\base;



/**
 * This is the model class for table "city.user_view_page".
 *
 * @property string $user_view_page_id
 * @property string $user_id
 * @property string $url
 * @property string $count
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $user
 */
class BaseUserViewPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.user_view_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseUserViewPagePeer::USER_ID], 'integer'],
            [[BaseUserViewPagePeer::COUNT, BaseUserViewPagePeer::STATUS], 'string'],
            [[BaseUserViewPagePeer::CHANGED], 'safe'],
            [[BaseUserViewPagePeer::URL], 'string', 'max' => 32],
            [[BaseUserViewPagePeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseUserViewPagePeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseUserViewPagePeer::USER_VIEW_PAGE_ID => 'User View Page ID',
            BaseUserViewPagePeer::USER_ID => 'User ID',
            BaseUserViewPagePeer::URL => 'Url',
            BaseUserViewPagePeer::COUNT => 'Count',
            BaseUserViewPagePeer::STATUS => 'Status',
            BaseUserViewPagePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseUserViewPagePeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\UserViewPageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\UserViewPageQuery(get_called_class());
    }
}
