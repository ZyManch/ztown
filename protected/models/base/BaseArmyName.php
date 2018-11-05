<?php

namespace models\base;



/**
 * This is the model class for table "city.army_name".
 *
 * @property string $army_name_id
 * @property string $position
 * @property string $type
 * @property string $name
 * @property string $status
 * @property string $changed
 */
class BaseArmyName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.army_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseArmyNamePeer::POSITION, BaseArmyNamePeer::NAME], 'required'],
            [[BaseArmyNamePeer::POSITION], 'integer'],
            [[BaseArmyNamePeer::TYPE, BaseArmyNamePeer::STATUS], 'string'],
            [[BaseArmyNamePeer::CHANGED], 'safe'],
            [[BaseArmyNamePeer::NAME], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseArmyNamePeer::ARMY_NAME_ID => 'Army Name ID',
            BaseArmyNamePeer::POSITION => 'Position',
            BaseArmyNamePeer::TYPE => 'Type',
            BaseArmyNamePeer::NAME => 'Name',
            BaseArmyNamePeer::STATUS => 'Status',
            BaseArmyNamePeer::CHANGED => 'Changed',
        ];
    }

    /**
     * @inheritdoc
     * @return \models\ArmyNameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ArmyNameQuery(get_called_class());
    }
}
