<?php

namespace models\base;



/**
 * This is the model class for table "city.arena".
 *
 * @property string $arena_id
 * @property string $user_id
 * @property integer $level
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $user
 */
class BaseArena extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.arena';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseArenaPeer::USER_ID], 'required'],
            [[BaseArenaPeer::USER_ID, BaseArenaPeer::LEVEL], 'integer'],
            [[BaseArenaPeer::STATUS], 'string'],
            [[BaseArenaPeer::CHANGED], 'safe'],
            [[BaseArenaPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseArenaPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseArenaPeer::ARENA_ID => 'Arena ID',
            BaseArenaPeer::USER_ID => 'User ID',
            BaseArenaPeer::LEVEL => 'Level',
            BaseArenaPeer::STATUS => 'Status',
            BaseArenaPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseArenaPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ArenaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ArenaQuery(get_called_class());
    }
}
