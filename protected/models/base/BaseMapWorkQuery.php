<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MapWorkQuery;

/**
 * This is the ActiveQuery class for [[models\MapWork]].
 * @method MapWorkQuery filterByMapWorkId($value, $criteria = null)
 * @method MapWorkQuery filterByMapId($value, $criteria = null)
 * @method MapWorkQuery filterByWorkId($value, $criteria = null)
 * @method MapWorkQuery filterByCount($value, $criteria = null)
 * @method MapWorkQuery filterByStatus($value, $criteria = null)
 * @method MapWorkQuery filterByChanged($value, $criteria = null)
  * @method MapWorkQuery orderByMapWorkId($order = Criteria::ASC)
  * @method MapWorkQuery orderByMapId($order = Criteria::ASC)
  * @method MapWorkQuery orderByWorkId($order = Criteria::ASC)
  * @method MapWorkQuery orderByCount($order = Criteria::ASC)
  * @method MapWorkQuery orderByStatus($order = Criteria::ASC)
  * @method MapWorkQuery orderByChanged($order = Criteria::ASC)
  * @method MapWorkQuery withMap($params = [])
  * @method MapWorkQuery joinWithMap($params = null, $joinType = 'LEFT JOIN')
  * @method MapWorkQuery withWork($params = [])
  * @method MapWorkQuery joinWithWork($params = null, $joinType = 'LEFT JOIN')
 */
class BaseMapWorkQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\MapWork[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\MapWork|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MapWorkQuery     */
    public static function model()
    {
        return new \models\MapWorkQuery(\models\MapWork::class);
    }
}
