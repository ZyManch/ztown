<?php

namespace models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property string $report_id
 * @property string $title
 * @property string $user_first_id
 * @property string $user_second_id
 * @property string $money
 * @property string $date
 * @property string $status
 * @property string $changed
 *
 * @property User $userFirst
 * @property User $userSecond
 */
class Report extends base\BaseReport {
}