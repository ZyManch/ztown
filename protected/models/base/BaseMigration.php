<?php

namespace models\base;



/**
 * This is the model class for table "city._migration".
 *
 * @property string $version
 * @property integer $apply_time
 */
class BaseMigration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city._migration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMigrationPeer::VERSION], 'required'],
            [[BaseMigrationPeer::APPLY_TIME], 'integer'],
            [[BaseMigrationPeer::VERSION], 'string', 'max' => 180],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMigrationPeer::VERSION => 'Version',
            BaseMigrationPeer::APPLY_TIME => 'Apply Time',
        ];
    }

    /**
     * @inheritdoc
     * @return \models\MigrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MigrationQuery(get_called_class());
    }
}
