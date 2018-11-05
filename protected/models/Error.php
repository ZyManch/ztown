<?php

namespace models;

use Yii;

/**
 * This is the model class for table "error".
 *
 * @property string $error_id
 * @property string $user_id
 * @property string $page
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property User $user
 */
class Error extends base\BaseError {
}