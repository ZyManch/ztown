<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ReportQuery;

/**
 * This is the ActiveQuery class for [[models\Report]].
 * @method ReportQuery filterByReportId($value, $criteria = null)
 * @method ReportQuery filterByTitle($value, $criteria = null)
 * @method ReportQuery filterByUserFirstId($value, $criteria = null)
 * @method ReportQuery filterByUserSecondId($value, $criteria = null)
 * @method ReportQuery filterByMoney($value, $criteria = null)
 * @method ReportQuery filterByDate($value, $criteria = null)
 * @method ReportQuery filterByStatus($value, $criteria = null)
 * @method ReportQuery filterByChanged($value, $criteria = null)
  * @method ReportQuery orderByReportId($order = Criteria::ASC)
  * @method ReportQuery orderByTitle($order = Criteria::ASC)
  * @method ReportQuery orderByUserFirstId($order = Criteria::ASC)
  * @method ReportQuery orderByUserSecondId($order = Criteria::ASC)
  * @method ReportQuery orderByMoney($order = Criteria::ASC)
  * @method ReportQuery orderByDate($order = Criteria::ASC)
  * @method ReportQuery orderByStatus($order = Criteria::ASC)
  * @method ReportQuery orderByChanged($order = Criteria::ASC)
  * @method ReportQuery withUserFirst($params = [])
  * @method ReportQuery joinWithUserFirst($params = null, $joinType = 'LEFT JOIN')
  * @method ReportQuery withUserSecond($params = [])
  * @method ReportQuery joinWithUserSecond($params = null, $joinType = 'LEFT JOIN')
 */
class BaseReportQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Report[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Report|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ReportQuery     */
    public static function model()
    {
        return new \models\ReportQuery(\models\Report::class);
    }
}
