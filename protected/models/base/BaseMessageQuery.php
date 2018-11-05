<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MessageQuery;

/**
 * This is the ActiveQuery class for [[models\Message]].
 * @method MessageQuery filterByMessageId($value, $criteria = null)
 * @method MessageQuery filterByUserFirstId($value, $criteria = null)
 * @method MessageQuery filterByUserSecondId($value, $criteria = null)
 * @method MessageQuery filterByTitle($value, $criteria = null)
 * @method MessageQuery filterByContent($value, $criteria = null)
 * @method MessageQuery filterByCreated($value, $criteria = null)
 * @method MessageQuery filterByReaded($value, $criteria = null)
 * @method MessageQuery filterByStatus($value, $criteria = null)
 * @method MessageQuery filterByChanged($value, $criteria = null)
  * @method MessageQuery orderByMessageId($order = Criteria::ASC)
  * @method MessageQuery orderByUserFirstId($order = Criteria::ASC)
  * @method MessageQuery orderByUserSecondId($order = Criteria::ASC)
  * @method MessageQuery orderByTitle($order = Criteria::ASC)
  * @method MessageQuery orderByContent($order = Criteria::ASC)
  * @method MessageQuery orderByCreated($order = Criteria::ASC)
  * @method MessageQuery orderByReaded($order = Criteria::ASC)
  * @method MessageQuery orderByStatus($order = Criteria::ASC)
  * @method MessageQuery orderByChanged($order = Criteria::ASC)
  * @method MessageQuery withUserFirst($params = [])
  * @method MessageQuery joinWithUserFirst($params = null, $joinType = 'LEFT JOIN')
  * @method MessageQuery withUserSecond($params = [])
  * @method MessageQuery joinWithUserSecond($params = null, $joinType = 'LEFT JOIN')
 */
class BaseMessageQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Message[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Message|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MessageQuery     */
    public static function model()
    {
        return new \models\MessageQuery(\models\Message::class);
    }
}
