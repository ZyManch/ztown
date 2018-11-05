<?php

namespace forms;

use yii\base\Model;

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangeLoginForm extends Model {

    public $login;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array(
			array('login', 'unique', 'attributeName' => 'login','caseSensitive' => false,'className' => 'User'),
            array('login', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'),
		);
	}

    public function attributeLabels() {
        return array(
            'login'  => 'Логин',
        );
    }

    public function changeLogin(User $user) {
        if ($this->login) {
            $scenario = $user->getScenario();
            $user->setScenario('changeLogin');
            $user->login = $this->login;
            if (!$user->save()) {
                throw new Exception('Cant change login: '.implode(',', array_map('reset', $user->getErrors())));
            }
            $user->setScenario($scenario);
            $user->canChangeName->delete();
        }
    }

}
