<?php

namespace models;

use Yii;

/**
 * This is the model class for table "forum".
 *
 * @property string $forum_id
 * @property string $parent_id
 * @property string $title
 * @property string $user_id
 * @property string $group_id
 * @property string $updated
 * @property string $visibled
 * @property string $enabled
 * @property string $is_topic
 * @property string $position
 * @property string $topics
 * @property string $status
 * @property string $changed
 *
 * @property Group $group
 * @property Forum $parent
 * @property Forum[] $forums
 * @property User $user
 * @property Topic[] $topics0
 */
class Forum extends base\BaseForum {
}