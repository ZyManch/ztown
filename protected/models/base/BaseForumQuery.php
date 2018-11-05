<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ForumQuery;

/**
 * This is the ActiveQuery class for [[models\Forum]].
 * @method ForumQuery filterByForumId($value, $criteria = null)
 * @method ForumQuery filterByParentId($value, $criteria = null)
 * @method ForumQuery filterByTitle($value, $criteria = null)
 * @method ForumQuery filterByUserId($value, $criteria = null)
 * @method ForumQuery filterByGroupId($value, $criteria = null)
 * @method ForumQuery filterByUpdated($value, $criteria = null)
 * @method ForumQuery filterByVisibled($value, $criteria = null)
 * @method ForumQuery filterByEnabled($value, $criteria = null)
 * @method ForumQuery filterByIsTopic($value, $criteria = null)
 * @method ForumQuery filterByPosition($value, $criteria = null)
 * @method ForumQuery filterByTopics($value, $criteria = null)
 * @method ForumQuery filterByStatus($value, $criteria = null)
 * @method ForumQuery filterByChanged($value, $criteria = null)
  * @method ForumQuery orderByForumId($order = Criteria::ASC)
  * @method ForumQuery orderByParentId($order = Criteria::ASC)
  * @method ForumQuery orderByTitle($order = Criteria::ASC)
  * @method ForumQuery orderByUserId($order = Criteria::ASC)
  * @method ForumQuery orderByGroupId($order = Criteria::ASC)
  * @method ForumQuery orderByUpdated($order = Criteria::ASC)
  * @method ForumQuery orderByVisibled($order = Criteria::ASC)
  * @method ForumQuery orderByEnabled($order = Criteria::ASC)
  * @method ForumQuery orderByIsTopic($order = Criteria::ASC)
  * @method ForumQuery orderByPosition($order = Criteria::ASC)
  * @method ForumQuery orderByTopics($order = Criteria::ASC)
  * @method ForumQuery orderByStatus($order = Criteria::ASC)
  * @method ForumQuery orderByChanged($order = Criteria::ASC)
  * @method ForumQuery withGroup($params = [])
  * @method ForumQuery joinWithGroup($params = null, $joinType = 'LEFT JOIN')
  * @method ForumQuery withParent($params = [])
  * @method ForumQuery joinWithParent($params = null, $joinType = 'LEFT JOIN')
  * @method ForumQuery withForums($params = [])
  * @method ForumQuery joinWithForums($params = null, $joinType = 'LEFT JOIN')
  * @method ForumQuery withUser($params = [])
  * @method ForumQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
  * @method ForumQuery withTopics0($params = [])
  * @method ForumQuery joinWithTopics0($params = null, $joinType = 'LEFT JOIN')
 */
class BaseForumQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Forum[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Forum|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ForumQuery     */
    public static function model()
    {
        return new \models\ForumQuery(\models\Forum::class);
    }
}
