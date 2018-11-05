<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\UserCanChangeNameQuery;

/**
 * This is the ActiveQuery class for [[models\UserCanChangeName]].
 * @method UserCanChangeNameQuery filterByUserCanChangeNameId($value, $criteria = null)
 * @method UserCanChangeNameQuery filterByUserId($value, $criteria = null)
 * @method UserCanChangeNameQuery filterByExpires($value, $criteria = null)
 * @method UserCanChangeNameQuery filterByStatus($value, $criteria = null)
 * @method UserCanChangeNameQuery filterByChanged($value, $criteria = null)
  * @method UserCanChangeNameQuery orderByUserCanChangeNameId($order = Criteria::ASC)
  * @method UserCanChangeNameQuery orderByUserId($order = Criteria::ASC)
  * @method UserCanChangeNameQuery orderByExpires($order = Criteria::ASC)
  * @method UserCanChangeNameQuery orderByStatus($order = Criteria::ASC)
  * @method UserCanChangeNameQuery orderByChanged($order = Criteria::ASC)
  * @method UserCanChangeNameQuery withUser($params = [])
  * @method UserCanChangeNameQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseUserCanChangeNameQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\UserCanChangeName[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\UserCanChangeName|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\UserCanChangeNameQuery     */
    public static function model()
    {
        return new \models\UserCanChangeNameQuery(\models\UserCanChangeName::class);
    }
}
