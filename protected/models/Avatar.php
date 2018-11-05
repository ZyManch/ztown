<?php

namespace models;

use Yii;

/**
 * This is the model class for table "avatar".
 *
 * @property string $avatar_id
 * @property string $position
 * @property string $filename
 * @property string $status
 * @property string $changed
 */
class Avatar extends base\BaseAvatar {

    const AVATAR_PATH = '/images/avatars/';

    const AVATAR_WIDTH = 70;

}