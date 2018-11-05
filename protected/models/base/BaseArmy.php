<?php

namespace models\base;



/**
 * This is the model class for table "city.army".
 *
 * @property string $army_id
 * @property string $parent_id
 * @property string $stat
 * @property string $name
 * @property string $status
 * @property string $changed
 */
class BaseArmy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.army';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseArmyPeer::PARENT_ID, BaseArmyPeer::STAT, BaseArmyPeer::NAME], 'required'],
            [[BaseArmyPeer::PARENT_ID, BaseArmyPeer::STAT], 'integer'],
            [[BaseArmyPeer::STATUS], 'string'],
            [[BaseArmyPeer::CHANGED], 'safe'],
            [[BaseArmyPeer::NAME], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseArmyPeer::ARMY_ID => 'Army ID',
            BaseArmyPeer::PARENT_ID => 'Parent ID',
            BaseArmyPeer::STAT => 'Stat',
            BaseArmyPeer::NAME => 'Name',
            BaseArmyPeer::STATUS => 'Status',
            BaseArmyPeer::CHANGED => 'Changed',
        ];
    }

    /**
     * @inheritdoc
     * @return \models\ArmyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ArmyQuery(get_called_class());
    }
}
