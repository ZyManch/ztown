<?php

namespace models\base;



/**
 * This is the model class for table "city.error".
 *
 * @property string $error_id
 * @property string $user_id
 * @property string $page
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $user
 */
class BaseError extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.error';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseErrorPeer::USER_ID, BaseErrorPeer::PAGE], 'required'],
            [[BaseErrorPeer::USER_ID], 'integer'],
            [[BaseErrorPeer::STATUS], 'string'],
            [[BaseErrorPeer::CHANGED], 'safe'],
            [[BaseErrorPeer::PAGE], 'string', 'max' => 64],
            [[BaseErrorPeer::CONTENT], 'string', 'max' => 256],
            [[BaseErrorPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseErrorPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseErrorPeer::ERROR_ID => 'Error ID',
            BaseErrorPeer::USER_ID => 'User ID',
            BaseErrorPeer::PAGE => 'Page',
            BaseErrorPeer::CONTENT => 'Content',
            BaseErrorPeer::STATUS => 'Status',
            BaseErrorPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseErrorPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ErrorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ErrorQuery(get_called_class());
    }
}
