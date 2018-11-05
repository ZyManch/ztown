<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\UserAnimalQuery;

/**
 * This is the ActiveQuery class for [[models\UserAnimal]].
 * @method UserAnimalQuery filterByUserAnimalId($value, $criteria = null)
 * @method UserAnimalQuery filterByUserId($value, $criteria = null)
 * @method UserAnimalQuery filterByAnimalId($value, $criteria = null)
 * @method UserAnimalQuery filterByStatId($value, $criteria = null)
 * @method UserAnimalQuery filterByLevel($value, $criteria = null)
 * @method UserAnimalQuery filterByExp($value, $criteria = null)
 * @method UserAnimalQuery filterByStatus($value, $criteria = null)
 * @method UserAnimalQuery filterByChanged($value, $criteria = null)
  * @method UserAnimalQuery orderByUserAnimalId($order = Criteria::ASC)
  * @method UserAnimalQuery orderByUserId($order = Criteria::ASC)
  * @method UserAnimalQuery orderByAnimalId($order = Criteria::ASC)
  * @method UserAnimalQuery orderByStatId($order = Criteria::ASC)
  * @method UserAnimalQuery orderByLevel($order = Criteria::ASC)
  * @method UserAnimalQuery orderByExp($order = Criteria::ASC)
  * @method UserAnimalQuery orderByStatus($order = Criteria::ASC)
  * @method UserAnimalQuery orderByChanged($order = Criteria::ASC)
  * @method UserAnimalQuery withAnimal($params = [])
  * @method UserAnimalQuery joinWithAnimal($params = null, $joinType = 'LEFT JOIN')
  * @method UserAnimalQuery withStat($params = [])
  * @method UserAnimalQuery joinWithStat($params = null, $joinType = 'LEFT JOIN')
  * @method UserAnimalQuery withUser($params = [])
  * @method UserAnimalQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseUserAnimalQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\UserAnimal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\UserAnimal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\UserAnimalQuery     */
    public static function model()
    {
        return new \models\UserAnimalQuery(\models\UserAnimal::class);
    }
}
