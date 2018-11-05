<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\AnimalQuery;

/**
 * This is the ActiveQuery class for [[models\Animal]].
 * @method AnimalQuery filterByAnimalId($value, $criteria = null)
 * @method AnimalQuery filterByLevel($value, $criteria = null)
 * @method AnimalQuery filterByStatId($value, $criteria = null)
 * @method AnimalQuery filterByName($value, $criteria = null)
 * @method AnimalQuery filterByType($value, $criteria = null)
 * @method AnimalQuery filterByContent($value, $criteria = null)
 * @method AnimalQuery filterByStatus($value, $criteria = null)
 * @method AnimalQuery filterByChanged($value, $criteria = null)
  * @method AnimalQuery orderByAnimalId($order = Criteria::ASC)
  * @method AnimalQuery orderByLevel($order = Criteria::ASC)
  * @method AnimalQuery orderByStatId($order = Criteria::ASC)
  * @method AnimalQuery orderByName($order = Criteria::ASC)
  * @method AnimalQuery orderByType($order = Criteria::ASC)
  * @method AnimalQuery orderByContent($order = Criteria::ASC)
  * @method AnimalQuery orderByStatus($order = Criteria::ASC)
  * @method AnimalQuery orderByChanged($order = Criteria::ASC)
  * @method AnimalQuery withStat($params = [])
  * @method AnimalQuery joinWithStat($params = null, $joinType = 'LEFT JOIN')
  * @method AnimalQuery withUserAnimals($params = [])
  * @method AnimalQuery joinWithUserAnimals($params = null, $joinType = 'LEFT JOIN')
 */
class BaseAnimalQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Animal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Animal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\AnimalQuery     */
    public static function model()
    {
        return new \models\AnimalQuery(\models\Animal::class);
    }
}
