<?php

namespace models;

use Yii;

/**
 * This is the model class for table "user_view_page".
 *
 * @property string $user_view_page_id
 * @property string $user_id
 * @property string $url
 * @property string $count
 * @property string $status
 * @property string $changed
 *
 * @property User $user
 */
class UserViewPage extends base\BaseUserViewPage {

    const COUNT_NEVER = 'Never';
    const COUNT_ONE = 'One';
    const COUNT_ALWAYS = 'Always';


    public function isCurrentUrl() {
        return strpos($_SERVER['REQUEST_URI'], $this->url) == 0;
    }

    public function redirect() {
        \Yii::$app->response->redirect($this->url);
    }
}