<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\GroupQueryQuery;

/**
 * This is the ActiveQuery class for [[models\GroupQuery]].
 * @method GroupQueryQuery filterByGroupQueryId($value, $criteria = null)
 * @method GroupQueryQuery filterByAuthorId($value, $criteria = null)
 * @method GroupQueryQuery filterByUserId($value, $criteria = null)
 * @method GroupQueryQuery filterByGroupId($value, $criteria = null)
 * @method GroupQueryQuery filterByDate($value, $criteria = null)
 * @method GroupQueryQuery filterByStatus($value, $criteria = null)
 * @method GroupQueryQuery filterByChanged($value, $criteria = null)
  * @method GroupQueryQuery orderByGroupQueryId($order = Criteria::ASC)
  * @method GroupQueryQuery orderByAuthorId($order = Criteria::ASC)
  * @method GroupQueryQuery orderByUserId($order = Criteria::ASC)
  * @method GroupQueryQuery orderByGroupId($order = Criteria::ASC)
  * @method GroupQueryQuery orderByDate($order = Criteria::ASC)
  * @method GroupQueryQuery orderByStatus($order = Criteria::ASC)
  * @method GroupQueryQuery orderByChanged($order = Criteria::ASC)
  * @method GroupQueryQuery withAuthor($params = [])
  * @method GroupQueryQuery joinWithAuthor($params = null, $joinType = 'LEFT JOIN')
  * @method GroupQueryQuery withGroup($params = [])
  * @method GroupQueryQuery joinWithGroup($params = null, $joinType = 'LEFT JOIN')
  * @method GroupQueryQuery withUser($params = [])
  * @method GroupQueryQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseGroupQueryQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\GroupQuery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\GroupQuery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\GroupQueryQuery     */
    public static function model()
    {
        return new \models\GroupQueryQuery(\models\GroupQuery::class);
    }
}
