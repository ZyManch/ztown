<?php

namespace models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property string $topic_id
 * @property string $user_id
 * @property string $forum_id
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property Forum $forum
 * @property User $user
 */
class Topic extends base\BaseTopic {
}