<?php

namespace forms;

use models\User;
use yii\base\Model;

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends Model {

	public $username;
	public $password;
	public $rememberMe = false;

	private $_user;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
			[['username', 'password'], 'required'],
			['rememberMe', 'boolean'],
			['password', 'validatePassword'],
		];
	}

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $identity = $this->getUserIdentity();
            if (!$identity || !$identity->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUserIdentity(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUserIdentity()
    {
        if ($this->_user === null) {
            $this->_user = User::find()->where('login = :username', [':username' => $this->username])->one();
        }
        return $this->_user;
    }
}
