<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\WorkBonusQuery;

/**
 * This is the ActiveQuery class for [[models\WorkBonus]].
 * @method WorkBonusQuery filterByWorkBonusId($value, $criteria = null)
 * @method WorkBonusQuery filterByWorkId($value, $criteria = null)
 * @method WorkBonusQuery filterByAddSubLevels($value, $criteria = null)
 * @method WorkBonusQuery filterByStatus($value, $criteria = null)
 * @method WorkBonusQuery filterByChanged($value, $criteria = null)
  * @method WorkBonusQuery orderByWorkBonusId($order = Criteria::ASC)
  * @method WorkBonusQuery orderByWorkId($order = Criteria::ASC)
  * @method WorkBonusQuery orderByAddSubLevels($order = Criteria::ASC)
  * @method WorkBonusQuery orderByStatus($order = Criteria::ASC)
  * @method WorkBonusQuery orderByChanged($order = Criteria::ASC)
  * @method WorkBonusQuery withWork($params = [])
  * @method WorkBonusQuery joinWithWork($params = null, $joinType = 'LEFT JOIN')
 */
class BaseWorkBonusQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\WorkBonus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\WorkBonus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\WorkBonusQuery     */
    public static function model()
    {
        return new \models\WorkBonusQuery(\models\WorkBonus::class);
    }
}
