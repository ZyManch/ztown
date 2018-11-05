<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MafiaInfoQuery;

/**
 * This is the ActiveQuery class for [[models\MafiaInfo]].
 * @method MafiaInfoQuery filterByMafiaInfoId($value, $criteria = null)
 * @method MafiaInfoQuery filterByGroupId($value, $criteria = null)
 * @method MafiaInfoQuery filterByMapId($value, $criteria = null)
 * @method MafiaInfoQuery filterByUserId($value, $criteria = null)
 * @method MafiaInfoQuery filterByStatus($value, $criteria = null)
 * @method MafiaInfoQuery filterByChanged($value, $criteria = null)
  * @method MafiaInfoQuery orderByMafiaInfoId($order = Criteria::ASC)
  * @method MafiaInfoQuery orderByGroupId($order = Criteria::ASC)
  * @method MafiaInfoQuery orderByMapId($order = Criteria::ASC)
  * @method MafiaInfoQuery orderByUserId($order = Criteria::ASC)
  * @method MafiaInfoQuery orderByStatus($order = Criteria::ASC)
  * @method MafiaInfoQuery orderByChanged($order = Criteria::ASC)
  * @method MafiaInfoQuery withGroup($params = [])
  * @method MafiaInfoQuery joinWithGroup($params = null, $joinType = 'LEFT JOIN')
  * @method MafiaInfoQuery withMap($params = [])
  * @method MafiaInfoQuery joinWithMap($params = null, $joinType = 'LEFT JOIN')
  * @method MafiaInfoQuery withUser($params = [])
  * @method MafiaInfoQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseMafiaInfoQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\MafiaInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\MafiaInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MafiaInfoQuery     */
    public static function model()
    {
        return new \models\MafiaInfoQuery(\models\MafiaInfo::class);
    }
}
