<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\SmileQuery;

/**
 * This is the ActiveQuery class for [[models\Smile]].
 * @method SmileQuery filterBySmileId($value, $criteria = null)
 * @method SmileQuery filterByFile($value, $criteria = null)
 * @method SmileQuery filterByBbcode($value, $criteria = null)
 * @method SmileQuery filterByVisible($value, $criteria = null)
 * @method SmileQuery filterByStatus($value, $criteria = null)
 * @method SmileQuery filterByChanged($value, $criteria = null)
  * @method SmileQuery orderBySmileId($order = Criteria::ASC)
  * @method SmileQuery orderByFile($order = Criteria::ASC)
  * @method SmileQuery orderByBbcode($order = Criteria::ASC)
  * @method SmileQuery orderByVisible($order = Criteria::ASC)
  * @method SmileQuery orderByStatus($order = Criteria::ASC)
  * @method SmileQuery orderByChanged($order = Criteria::ASC)
 */
class BaseSmileQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Smile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Smile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\SmileQuery     */
    public static function model()
    {
        return new \models\SmileQuery(\models\Smile::class);
    }
}
