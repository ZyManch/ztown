<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\TopicQuery;

/**
 * This is the ActiveQuery class for [[models\Topic]].
 * @method TopicQuery filterByTopicId($value, $criteria = null)
 * @method TopicQuery filterByUserId($value, $criteria = null)
 * @method TopicQuery filterByForumId($value, $criteria = null)
 * @method TopicQuery filterByContent($value, $criteria = null)
 * @method TopicQuery filterByStatus($value, $criteria = null)
 * @method TopicQuery filterByChanged($value, $criteria = null)
  * @method TopicQuery orderByTopicId($order = Criteria::ASC)
  * @method TopicQuery orderByUserId($order = Criteria::ASC)
  * @method TopicQuery orderByForumId($order = Criteria::ASC)
  * @method TopicQuery orderByContent($order = Criteria::ASC)
  * @method TopicQuery orderByStatus($order = Criteria::ASC)
  * @method TopicQuery orderByChanged($order = Criteria::ASC)
  * @method TopicQuery withForum($params = [])
  * @method TopicQuery joinWithForum($params = null, $joinType = 'LEFT JOIN')
  * @method TopicQuery withUser($params = [])
  * @method TopicQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseTopicQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Topic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Topic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\TopicQuery     */
    public static function model()
    {
        return new \models\TopicQuery(\models\Topic::class);
    }
}
