<?php

namespace models;

use Yii;

/**
 * This is the model class for table "group_query".
 *
 * @property string $group_query_id
 * @property string $author_id
 * @property string $user_id
 * @property string $group_id
 * @property string $date
 * @property string $status
 * @property string $changed
 *
 * @property User $author
 * @property Group $group
 * @property User $user
 */
class GroupRequest extends base\BaseGroupRequest {

}