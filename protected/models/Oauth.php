<?php

namespace models;

use Yii;

/**
 * This is the model class for table "oauth".
 *
 * @property string $oauth_id
 * @property string $user_id
 * @property string $server
 * @property string $remote_user_id
 * @property string $access_token
 * @property string $access_secret
 * @property string $status
 * @property string $changed
 *
 * @property User $user
 */
class Oauth extends base\BaseOauth {
}