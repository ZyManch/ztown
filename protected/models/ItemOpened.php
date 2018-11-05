<?php

namespace models;

use Yii;

/**
 * This is the model class for table "item_opened".
 *
 * @property string $item_opened_id
 * @property string $item_id
 * @property string $user_id
 * @property string $status
 * @property string $changed
 *
 * @property Item $item
 * @property User $user
 */
class ItemOpened extends base\BaseItemOpened {
}