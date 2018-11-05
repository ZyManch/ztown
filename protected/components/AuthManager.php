<?php
namespace components;

use models\User;
use yii\rbac\CheckAccessInterface;

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.03.2018
 * Time: 9:24
 */
class AuthManager implements CheckAccessInterface {

    public function checkAccess($userId, $permissionName, $params = []) {
        $user = User::findOne($userId);
        if (!$user) {
            return false;
        }
        return $user->isAdmin();
    }

}