<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ArmyQuery;

/**
 * This is the ActiveQuery class for [[models\Army]].
 * @method ArmyQuery filterByArmyId($value, $criteria = null)
 * @method ArmyQuery filterByParentId($value, $criteria = null)
 * @method ArmyQuery filterByStat($value, $criteria = null)
 * @method ArmyQuery filterByName($value, $criteria = null)
 * @method ArmyQuery filterByStatus($value, $criteria = null)
 * @method ArmyQuery filterByChanged($value, $criteria = null)
  * @method ArmyQuery orderByArmyId($order = Criteria::ASC)
  * @method ArmyQuery orderByParentId($order = Criteria::ASC)
  * @method ArmyQuery orderByStat($order = Criteria::ASC)
  * @method ArmyQuery orderByName($order = Criteria::ASC)
  * @method ArmyQuery orderByStatus($order = Criteria::ASC)
  * @method ArmyQuery orderByChanged($order = Criteria::ASC)
 */
class BaseArmyQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Army[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Army|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ArmyQuery     */
    public static function model()
    {
        return new \models\ArmyQuery(\models\Army::class);
    }
}
