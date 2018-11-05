<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\CourseQuery;

/**
 * This is the ActiveQuery class for [[models\Course]].
 * @method CourseQuery filterByCourseId($value, $criteria = null)
 * @method CourseQuery filterByCurrencyId($value, $criteria = null)
 * @method CourseQuery filterByPrice($value, $criteria = null)
 * @method CourseQuery filterByStatus($value, $criteria = null)
 * @method CourseQuery filterByChanged($value, $criteria = null)
  * @method CourseQuery orderByCourseId($order = Criteria::ASC)
  * @method CourseQuery orderByCurrencyId($order = Criteria::ASC)
  * @method CourseQuery orderByPrice($order = Criteria::ASC)
  * @method CourseQuery orderByStatus($order = Criteria::ASC)
  * @method CourseQuery orderByChanged($order = Criteria::ASC)
  * @method CourseQuery withCurrency($params = [])
  * @method CourseQuery joinWithCurrency($params = null, $joinType = 'LEFT JOIN')
 */
class BaseCourseQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Course[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Course|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\CourseQuery     */
    public static function model()
    {
        return new \models\CourseQuery(\models\Course::class);
    }
}
