<?php

namespace models\base;



/**
 * This is the model class for table "city.report".
 *
 * @property string $report_id
 * @property string $title
 * @property string $user_first_id
 * @property string $user_second_id
 * @property string $money
 * @property string $date
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $userFirst
 * @property \models\User $userSecond
 */
class BaseReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseReportPeer::TITLE, BaseReportPeer::USER_FIRST_ID, BaseReportPeer::USER_SECOND_ID, BaseReportPeer::MONEY], 'required'],
            [[BaseReportPeer::USER_FIRST_ID, BaseReportPeer::USER_SECOND_ID, BaseReportPeer::MONEY], 'integer'],
            [[BaseReportPeer::DATE, BaseReportPeer::CHANGED], 'safe'],
            [[BaseReportPeer::STATUS], 'string'],
            [[BaseReportPeer::TITLE], 'string', 'max' => 16],
            [[BaseReportPeer::USER_FIRST_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseReportPeer::USER_FIRST_ID => BaseUserPeer::USER_ID]],
            [[BaseReportPeer::USER_SECOND_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseReportPeer::USER_SECOND_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseReportPeer::REPORT_ID => 'Report ID',
            BaseReportPeer::TITLE => 'Title',
            BaseReportPeer::USER_FIRST_ID => 'User First ID',
            BaseReportPeer::USER_SECOND_ID => 'User Second ID',
            BaseReportPeer::MONEY => 'Money',
            BaseReportPeer::DATE => 'Date',
            BaseReportPeer::STATUS => 'Status',
            BaseReportPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUserFirst() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseReportPeer::USER_FIRST_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUserSecond() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseReportPeer::USER_SECOND_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ReportQuery(get_called_class());
    }
}
