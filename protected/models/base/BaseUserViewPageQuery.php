<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\UserViewPageQuery;

/**
 * This is the ActiveQuery class for [[models\UserViewPage]].
 * @method UserViewPageQuery filterByUserViewPageId($value, $criteria = null)
 * @method UserViewPageQuery filterByUserId($value, $criteria = null)
 * @method UserViewPageQuery filterByUrl($value, $criteria = null)
 * @method UserViewPageQuery filterByCount($value, $criteria = null)
 * @method UserViewPageQuery filterByStatus($value, $criteria = null)
 * @method UserViewPageQuery filterByChanged($value, $criteria = null)
  * @method UserViewPageQuery orderByUserViewPageId($order = Criteria::ASC)
  * @method UserViewPageQuery orderByUserId($order = Criteria::ASC)
  * @method UserViewPageQuery orderByUrl($order = Criteria::ASC)
  * @method UserViewPageQuery orderByCount($order = Criteria::ASC)
  * @method UserViewPageQuery orderByStatus($order = Criteria::ASC)
  * @method UserViewPageQuery orderByChanged($order = Criteria::ASC)
  * @method UserViewPageQuery withUser($params = [])
  * @method UserViewPageQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseUserViewPageQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\UserViewPage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\UserViewPage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\UserViewPageQuery     */
    public static function model()
    {
        return new \models\UserViewPageQuery(\models\UserViewPage::class);
    }
}
