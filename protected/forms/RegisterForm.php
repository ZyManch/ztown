<?php

namespace forms;

use models\User;
use yii\base\Model;

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends Model {

    public $email;
    public $login;
    public $avatar_id;
    public $password;
    public $password_repeat;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return [
            [['login', 'email', 'password', 'password_repeat'], 'required'],
            ['login', 'unique', 'targetAttribute' => 'login','targetClass' => User::class],
            ['email', 'unique', 'targetAttribute' => 'email','targetClass' => User::class],
            ['email', 'email'],
            [['login', 'password','password_repeat'], 'string' ,'min' => 3, 'max' => 16],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    public function attributeLabels() {
        return [
            'login'  => 'Логин',
            'email'  => 'E-Mail',
            'avatar_id'  => 'Аватар',
            'password'  => 'Пароль',
            'password_repeat'  => 'Повторите пароль'
        ];
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function register() {
        if ($this->hasErrors()) {
            return false;
        }
        $user = \models\User::create([
            'login' => $this->login,
            'email' => strtolower($this->email),
            'x' => \Yii::$app->params['start_x'],
            'y' => \Yii::$app->params['start_y']
        ]);
        if (!$user->save()) {
            throw new \Exception('Ошибка при создании юзера:'.implode(',', array_map('reset', $user->getErrors())));
        }
        $user->password = $user->getCryptedPassword($this->password);
        $user->changeAvatar(HOME.'images/avatars/default.jpg');
        if (!$user->save()) {
            throw new \Exception('Ошибка при создании юзера:'.implode(',', array_map('reset', $user->getErrors())));
        }
        $auth = new LoginForm();
        $auth->username = $this->login;
        $auth->password = $this->password;
        $auth->rememberMe = true;
        return $auth->login();
    }
}
