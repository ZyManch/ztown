<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\OauthQuery;

/**
 * This is the ActiveQuery class for [[models\Oauth]].
 * @method OauthQuery filterByOauthId($value, $criteria = null)
 * @method OauthQuery filterByUserId($value, $criteria = null)
 * @method OauthQuery filterByServer($value, $criteria = null)
 * @method OauthQuery filterByRemoteUserId($value, $criteria = null)
 * @method OauthQuery filterByAccessToken($value, $criteria = null)
 * @method OauthQuery filterByAccessSecret($value, $criteria = null)
 * @method OauthQuery filterByStatus($value, $criteria = null)
 * @method OauthQuery filterByChanged($value, $criteria = null)
  * @method OauthQuery orderByOauthId($order = Criteria::ASC)
  * @method OauthQuery orderByUserId($order = Criteria::ASC)
  * @method OauthQuery orderByServer($order = Criteria::ASC)
  * @method OauthQuery orderByRemoteUserId($order = Criteria::ASC)
  * @method OauthQuery orderByAccessToken($order = Criteria::ASC)
  * @method OauthQuery orderByAccessSecret($order = Criteria::ASC)
  * @method OauthQuery orderByStatus($order = Criteria::ASC)
  * @method OauthQuery orderByChanged($order = Criteria::ASC)
  * @method OauthQuery withUser($params = [])
  * @method OauthQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseOauthQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Oauth[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Oauth|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\OauthQuery     */
    public static function model()
    {
        return new \models\OauthQuery(\models\Oauth::class);
    }
}
