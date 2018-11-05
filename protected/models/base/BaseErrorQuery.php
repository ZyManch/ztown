<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ErrorQuery;

/**
 * This is the ActiveQuery class for [[models\Error]].
 * @method ErrorQuery filterByErrorId($value, $criteria = null)
 * @method ErrorQuery filterByUserId($value, $criteria = null)
 * @method ErrorQuery filterByPage($value, $criteria = null)
 * @method ErrorQuery filterByContent($value, $criteria = null)
 * @method ErrorQuery filterByStatus($value, $criteria = null)
 * @method ErrorQuery filterByChanged($value, $criteria = null)
  * @method ErrorQuery orderByErrorId($order = Criteria::ASC)
  * @method ErrorQuery orderByUserId($order = Criteria::ASC)
  * @method ErrorQuery orderByPage($order = Criteria::ASC)
  * @method ErrorQuery orderByContent($order = Criteria::ASC)
  * @method ErrorQuery orderByStatus($order = Criteria::ASC)
  * @method ErrorQuery orderByChanged($order = Criteria::ASC)
  * @method ErrorQuery withUser($params = [])
  * @method ErrorQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseErrorQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Error[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Error|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ErrorQuery     */
    public static function model()
    {
        return new \models\ErrorQuery(\models\Error::class);
    }
}
