<?php

namespace models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $course_id
 * @property string $currency_id
 * @property string $price
 * @property string $status
 * @property string $changed
 *
 * @property Currency $currency
 */
class Course extends base\BaseCourse {
}