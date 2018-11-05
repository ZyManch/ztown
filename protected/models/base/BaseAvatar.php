<?php

namespace models\base;



/**
 * This is the model class for table "city.avatar".
 *
 * @property string $avatar_id
 * @property string $position
 * @property string $filename
 * @property string $status
 * @property string $changed
 */
class BaseAvatar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.avatar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseAvatarPeer::POSITION, BaseAvatarPeer::FILENAME], 'required'],
            [[BaseAvatarPeer::POSITION], 'integer'],
            [[BaseAvatarPeer::STATUS], 'string'],
            [[BaseAvatarPeer::CHANGED], 'safe'],
            [[BaseAvatarPeer::FILENAME], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseAvatarPeer::AVATAR_ID => 'Avatar ID',
            BaseAvatarPeer::POSITION => 'Position',
            BaseAvatarPeer::FILENAME => 'Filename',
            BaseAvatarPeer::STATUS => 'Status',
            BaseAvatarPeer::CHANGED => 'Changed',
        ];
    }

    /**
     * @inheritdoc
     * @return \models\AvatarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\AvatarQuery(get_called_class());
    }
}
