<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\AvatarQuery;

/**
 * This is the ActiveQuery class for [[models\Avatar]].
 * @method AvatarQuery filterByAvatarId($value, $criteria = null)
 * @method AvatarQuery filterByPosition($value, $criteria = null)
 * @method AvatarQuery filterByFilename($value, $criteria = null)
 * @method AvatarQuery filterByStatus($value, $criteria = null)
 * @method AvatarQuery filterByChanged($value, $criteria = null)
  * @method AvatarQuery orderByAvatarId($order = Criteria::ASC)
  * @method AvatarQuery orderByPosition($order = Criteria::ASC)
  * @method AvatarQuery orderByFilename($order = Criteria::ASC)
  * @method AvatarQuery orderByStatus($order = Criteria::ASC)
  * @method AvatarQuery orderByChanged($order = Criteria::ASC)
 */
class BaseAvatarQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Avatar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Avatar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\AvatarQuery     */
    public static function model()
    {
        return new \models\AvatarQuery(\models\Avatar::class);
    }
}
