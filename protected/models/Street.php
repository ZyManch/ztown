<?php

namespace models;

use Yii;

/**
 * This is the model class for table "street".
 *
 * @property string $street_id
 * @property string $name
 * @property string $left_x
 * @property string $right_x
 * @property string $top_y
 * @property string $bottom_y
 * @property string $status
 * @property string $changed
 *
 * @property Map[] $maps
 */
class Street extends base\BaseStreet {
}