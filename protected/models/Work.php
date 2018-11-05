<?php

namespace models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property string $work_id
 * @property string $map_type_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $price_id
 * @property string $status
 * @property string $changed
 *
 * @property MapWork[] $mapWorks
 * @property MapType $mapType
 * @property Price $price
 * @property WorkBonus[] $workBonuses
 */
class Work extends base\BaseWork {
}