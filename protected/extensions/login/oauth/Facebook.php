<?php
Yii::import('ext.login.oauth.OAuthClient');
Yii::import('ext.login.facebook.src.facebook', true);
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 13.01.13
 * Time: 9:42
 */
class Facebook extends OAuthClient {

    const LOGIN_SERVER = 'facebook';

    /** @var Facebook\Facebook */
    protected $oauth;

    public function __construct(User $user = null) {
        parent::__construct($user);
        $this->oauth = new Facebook\Facebook(
            Yii::$app->params->clients[self::LOGIN_SERVER]['client_id'],
            Yii::$app->params->clients[self::LOGIN_SERVER]['client_code']
        );
    }

    public function getToken() {
        if (!isset($this->session['initialized'])) {
            $this->initAccessToken();
        }
        return $this->session['oauth_token'];
    }

    protected function initAccessToken() {
        $this->session['initialized'] = true;
        $this->session['oauth_token'] = $this->oauth->getAccessToken();
    }

    public function getTokenSecret() {

    }

    public function _getUser() {
        $userInfo = $this->request('https://graph.facebook.com/me', array(
             'fields' => 'name',
             'access_token' => $this->getToken())
        );
        $userInfo = $this->oauth->getUser();
        if (!$userInfo->id) {
            throw new Exception('Can`t get user info');
        }
        $oauth = OAuth::model()->findByAttributes(array(
           'remote_user_id' => $userInfo->id,
           'server'         => self::LOGIN_SERVER,
        ));
        /** @var $user User */
        /** @var $oauth OAuth */
        if ($oauth) {
            $user = $oauth->user;
        } else {
            $locale = explode('_',$userInfo->locale);
            $user = User::create(array(
                  'access'     => 'Player',
                  'login'      => $this->getUniqueLogin($userInfo->username),
                  'first_name' => $userInfo->first_name,
                  'last_name'  => $userInfo->last_name,
                  'lang'       => $locale[0]
             ),'oauth');
            if (!$user->save(false)) {
                throw new Exception('Ошибка при создании юзера: '. implode(',', array_map('reset', $user->getErrors())));
            }
            $oauth = OAuth::create(array(
                'user_id'        => $user->id,
                'server'         => self::LOGIN_SERVER,
                'remote_user_id' => $userInfo->id,
                'access_token'   => $this->getToken(),
            ));
            if (!$oauth->save()) {
                throw new Exception('Ошибка при создании связи с twitter: '. implode(',', array_map('reset', $oauth->getErrors())));
            }
            $userCanChangeName = UserCanChangeName::create(array(
                'user_id' => $user->id,
            ));
            if (!$userCanChangeName->save(false)) {
                throw new Exception('Ошибка при создании возможности редактировать имя: '. implode(',', array_map('reset', $userCanChangeName->getErrors())));
            }
            $this->redirectOnSuccessLogin = array('site/changeLogin');
        }
        return $user;
    }

    public function getLoginUrl($authenticateUrl) {
        return $this->oauth->getLoginUrl(array(
            'redirect_uri' => Yii::$app->request->hostInfo.CHtml::normalizeUrl(array('site/oauth','id' => 'facebook')),
            'scope' => 'read_stream'
        ));
    }

    public function getUniqueLogin($login) {
        $i = '';
        do {
            $newLogin = $login . ($i++);
            $user = User::model()->findByAttributes(array('login' => $newLogin));
        } while ($user);
        return $newLogin;
    }

}