<?php

namespace models\base;



/**
 * This is the model class for table "city.oauth".
 *
 * @property string $oauth_id
 * @property string $user_id
 * @property string $server
 * @property string $remote_user_id
 * @property string $access_token
 * @property string $access_secret
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $user
 */
class BaseOauth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.oauth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseOauthPeer::USER_ID, BaseOauthPeer::SERVER, BaseOauthPeer::REMOTE_USER_ID, BaseOauthPeer::ACCESS_TOKEN, BaseOauthPeer::ACCESS_SECRET], 'required'],
            [[BaseOauthPeer::USER_ID], 'integer'],
            [[BaseOauthPeer::STATUS], 'string'],
            [[BaseOauthPeer::CHANGED], 'safe'],
            [[BaseOauthPeer::SERVER], 'string', 'max' => 8],
            [[BaseOauthPeer::REMOTE_USER_ID], 'string', 'max' => 10],
            [[BaseOauthPeer::ACCESS_TOKEN, BaseOauthPeer::ACCESS_SECRET], 'string', 'max' => 64],
            [[BaseOauthPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseOauthPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseOauthPeer::OAUTH_ID => 'Oauth ID',
            BaseOauthPeer::USER_ID => 'User ID',
            BaseOauthPeer::SERVER => 'Server',
            BaseOauthPeer::REMOTE_USER_ID => 'Remote User ID',
            BaseOauthPeer::ACCESS_TOKEN => 'Access Token',
            BaseOauthPeer::ACCESS_SECRET => 'Access Secret',
            BaseOauthPeer::STATUS => 'Status',
            BaseOauthPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseOauthPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\OauthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\OauthQuery(get_called_class());
    }
}
