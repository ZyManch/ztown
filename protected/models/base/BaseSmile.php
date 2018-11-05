<?php

namespace models\base;



/**
 * This is the model class for table "city.smile".
 *
 * @property string $smile_id
 * @property string $file
 * @property string $bbcode
 * @property string $visible
 * @property string $status
 * @property string $changed
 */
class BaseSmile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.smile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseSmilePeer::FILE, BaseSmilePeer::BBCODE], 'required'],
            [[BaseSmilePeer::VISIBLE, BaseSmilePeer::STATUS], 'string'],
            [[BaseSmilePeer::CHANGED], 'safe'],
            [[BaseSmilePeer::FILE, BaseSmilePeer::BBCODE], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseSmilePeer::SMILE_ID => 'Smile ID',
            BaseSmilePeer::FILE => 'File',
            BaseSmilePeer::BBCODE => 'Bbcode',
            BaseSmilePeer::VISIBLE => 'Visible',
            BaseSmilePeer::STATUS => 'Status',
            BaseSmilePeer::CHANGED => 'Changed',
        ];
    }

    /**
     * @inheritdoc
     * @return \models\SmileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\SmileQuery(get_called_class());
    }
}
