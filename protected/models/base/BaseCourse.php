<?php

namespace models\base;



/**
 * This is the model class for table "city.course".
 *
 * @property string $course_id
 * @property string $currency_id
 * @property string $price
 * @property string $status
 * @property string $changed
 *
 * @property \models\Currency $currency
 */
class BaseCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseCoursePeer::CURRENCY_ID, BaseCoursePeer::PRICE], 'required'],
            [[BaseCoursePeer::CURRENCY_ID], 'integer'],
            [[BaseCoursePeer::PRICE], 'number'],
            [[BaseCoursePeer::STATUS], 'string'],
            [[BaseCoursePeer::CHANGED], 'safe'],
            [[BaseCoursePeer::CURRENCY_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseCurrency::className(), 'targetAttribute' => [BaseCoursePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseCoursePeer::COURSE_ID => 'Course ID',
            BaseCoursePeer::CURRENCY_ID => 'Currency ID',
            BaseCoursePeer::PRICE => 'Price',
            BaseCoursePeer::STATUS => 'Status',
            BaseCoursePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\CurrencyQuery
     */
    public function getCurrency() {
        return $this->hasOne(\models\Currency::className(), [BaseCurrencyPeer::CURRENCY_ID => BaseCoursePeer::CURRENCY_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\CourseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\CourseQuery(get_called_class());
    }
}
