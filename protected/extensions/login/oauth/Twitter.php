<?php
Yii::import('ext.login.oauth.OAuthClient');
Yii::import('ext.login.twitter.twitteroauth.OAuth', true);
Yii::import('ext.login.twitter.twitteroauth.twitteroauth', true);
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 13.01.13
 * Time: 9:42
 */
class Twitter extends OAuthClient {

    const LOGIN_SERVER = 'twitter';

    /** @var TwitterOAuth */
    protected $oauth;

    public function __construct(User $user = null) {
        parent::__construct($user);
        $this->oauth = new TwitterOAuth(
            Yii::$app->params->clients[self::LOGIN_SERVER]['client_id'],
            Yii::$app->params->clients[self::LOGIN_SERVER]['client_code'],
            isset($this->session['oauth_token'])        ? $this->session['oauth_token'] : null,
            isset($this->session['oauth_token_secret']) ? $this->session['oauth_token_secret'] : null
        );
    }

    protected function _getAuthCodeName() {
        return 'oauth_token';
    }

    public function getToken() {
        if (!isset($this->session['initialized'])) {
            $this->initAccessToken();
        }
        return $this->session['oauth_token'];
    }

    public function getTokenSecret() {
        if (!isset($this->session['initialized'])) {
            $this->initAccessToken();
        }
        return $this->session['oauth_token_secret'];
    }

    protected function initAccessToken() {
        if (!isset($this->session['oauth_token']) ||
            $this->session['oauth_token'] != Yii::$app->request->getParam('oauth_token')
        ) {
            throw new CHttpException('Повторите попытку аутентификаии позже ['.$this->session['oauth_token'].','.Yii::$app->request->getParam('oauth_token').']');
        }
        $accessToken = $this->oauth->getAccessToken(
            Yii::$app->request->getParam('oauth_verifier')
        );
        if (!isset($accessToken['oauth_token']) || !isset($accessToken['oauth_token_secret'])) {
            throw new CHttpException('Returned invalid token');
        }
        $this->session['initialized'] = true;
        $this->session['oauth_token'] = $accessToken['oauth_token'];
        $this->session['oauth_token_secret'] = $accessToken['oauth_token_secret'];
        $this->oauth = new TwitterOAuth(
            Yii::$app->params->clients[self::LOGIN_SERVER]['client_id'],
            Yii::$app->params->clients[self::LOGIN_SERVER]['client_code'],
            $this->session['oauth_token'],
            $this->session['oauth_token_secret']
        );

    }

    public function _getUser() {
        $userInfo = $this->oauth->get('account/verify_credentials');
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
            $userName = explode(' ', $userInfo->name, 2);
            $user = User::create(array(
                'access' => 'Player',
                'login'  => $this->getUniqueLogin($userInfo->screen_name),
                'first_name' => isset($userName[1]) ? $userName[1] : '',
                'last_name' => $userName[0],
                'lang' => $userInfo->lang
            ),'oauth');
            $user->changeAvatar($userInfo->profile_image_url);
            if (!$user->save(false)) {
                throw new Exception('Ошибка при создании юзера: '. implode(',', array_map('reset', $user->getErrors())));
            }
            $oauth = OAuth::create(array(
                'user_id'        => $user->id,
                'server'         => self::LOGIN_SERVER,
                'remote_user_id' => $userInfo->id,
                'access_token'   => $this->session['oauth_token'],
                'access_secret'  => $this->session['oauth_token_secret'],
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
        if (isset($this->session['oauth_token']) || isset($this->session['oauth_token_secret'])) {
            $this->session = array();
            $this->saveSession();
            Yii::$app->controller->refresh();
        }
        $request = $this->oauth->getRequestToken($authenticateUrl);
        if (!isset($request['oauth_token']) && !isset($request['oauth_token_secret'])) {
            throw new CException(reset(array_keys($request)));
        }
        $this->session['oauth_token'] = $request['oauth_token'];
        $this->session['oauth_token_secret'] = $request['oauth_token_secret'];
        return $this->oauth->getAuthorizeURL($request['oauth_token'], false);
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