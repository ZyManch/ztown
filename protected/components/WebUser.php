<?php
namespace components;
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 06.05.12
 * Time: 11:21
 * To change this template use File | Settings | File Templates.
 * @property int $money
 */
class WebUser extends CWebUser {

    protected $user;

    public function isGuest() {
        return $this->getIsGuest();
    }

    /**
     * @return User
     */
    public function getUser() {
        if (($id = $this->getId()) && is_null($this->user)) {
            $this->user = User::model()->findByPk($id);
        }
        return $this->user;
    }

    public function __call($name,$parameters) {
        if ($user = $this->getUser()) {
            return call_user_func_array(array($user, $name), $parameters);
        }
        return parent::__call($name,$parameters);
    }

    public function __get($key) {
        if ($user = $this->getUser()) {
            return $user->$key;
        }
        return parent::__get($key);
    }


    public function setUserMesage($text) {
        $this->setFlash('status', $text);
    }
}