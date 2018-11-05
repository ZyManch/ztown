<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MigrationQuery;

/**
 * This is the ActiveQuery class for [[models\Migration]].
 * @method MigrationQuery filterByVersion($value, $criteria = null)
 * @method MigrationQuery filterByApplyTime($value, $criteria = null)
  * @method MigrationQuery orderByVersion($order = Criteria::ASC)
  * @method MigrationQuery orderByApplyTime($order = Criteria::ASC)
 */
class BaseMigrationQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Migration[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Migration|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MigrationQuery     */
    public static function model()
    {
        return new \models\MigrationQuery(\models\Migration::class);
    }
}
