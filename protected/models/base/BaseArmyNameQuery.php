<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ArmyNameQuery;

/**
 * This is the ActiveQuery class for [[models\ArmyName]].
 * @method ArmyNameQuery filterByArmyNameId($value, $criteria = null)
 * @method ArmyNameQuery filterByPosition($value, $criteria = null)
 * @method ArmyNameQuery filterByType($value, $criteria = null)
 * @method ArmyNameQuery filterByName($value, $criteria = null)
 * @method ArmyNameQuery filterByStatus($value, $criteria = null)
 * @method ArmyNameQuery filterByChanged($value, $criteria = null)
  * @method ArmyNameQuery orderByArmyNameId($order = Criteria::ASC)
  * @method ArmyNameQuery orderByPosition($order = Criteria::ASC)
  * @method ArmyNameQuery orderByType($order = Criteria::ASC)
  * @method ArmyNameQuery orderByName($order = Criteria::ASC)
  * @method ArmyNameQuery orderByStatus($order = Criteria::ASC)
  * @method ArmyNameQuery orderByChanged($order = Criteria::ASC)
 */
class BaseArmyNameQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\ArmyName[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\ArmyName|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ArmyNameQuery     */
    public static function model()
    {
        return new \models\ArmyNameQuery(\models\ArmyName::class);
    }
}
