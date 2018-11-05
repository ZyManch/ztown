<?php

namespace models;

use Yii;

/**
 * This is the model class for table "map_work".
 *
 * @property string $map_work_id
 * @property string $map_id
 * @property string $work_id
 * @property string $count
 * @property string $status
 * @property string $changed
 *
 * @property Map $map
 * @property Work $work
 */
class MapWork extends base\BaseMapWork {
}