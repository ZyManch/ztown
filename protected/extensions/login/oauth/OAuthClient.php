<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 12.01.13
 * Time: 9:34
 */
abstract class OAuthClient extends CBaseUserIdentity{

    /**
     * @var User
     */
    protected $_user = null;

    const LOGIN_TYPE = 'oauth';

    const ERROR_PARAMS_MISSED = 3;

    const SESSION_KEY = 'oauth_session';

    protected $redirectOnSuccessLogin = array('maps/index');

    /** @var array */
    protected $session = array();

    protected function _getAuthCodeName() {
        return 'oauth_code';
    }

    public function isAuthCodeReturned() {
        return (bool) Yii::$app->request->getParam($this->_getAuthCodeName(), false);
    }

    public function __construct(User $user = null) {
        if (isset(Yii::$app->session[self::SESSION_KEY])) {
            $this->session = Yii::$app->session[self::SESSION_KEY];
        }
    }

    public function getRedirectOnSuccessLogin() {
        return $this->redirectOnSuccessLogin;
    }

    public function saveSession() {
        Yii::$app->session[self::SESSION_KEY] = $this->session;
    }

    abstract protected function getLoginUrl($authenticateUrl);

    abstract public function getToken();

    abstract public function getTokenSecret();
    /**
     * @return User
     */
    abstract public function _getUser();

    /**
     * @return User
     */
    public function getUser() {
        return $this->_user;
    }

    public function showLoginPage() {
        $redirectUrl = $this->getLoginUrl(
            'http://'.$_SERVER["HTTP_HOST"].CHtml::normalizeUrl(array(
                 'site/oauth',
                 'id' => Yii::$app->request->getParam('id')
            ))
        );
        $this->saveSession();
        Yii::$app->request->redirect($redirectUrl);
    }

    public function getId() {
        return $this->_user->id;
    }

    public function getName() {
        return $this->_user->login;
    }

    public function authenticate() {
        $token = $this->getToken();
        if (!$token) {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
            return false;
        }
        $this->_user = $this->_getUser();
        $this->errorCode=self::ERROR_NONE;
        return true;
    }

    protected function request($url, $data = array()) {
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_PORT , 443);
        curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
        curl_setopt($tuCurl, CURLOPT_HEADER, 0);
        curl_setopt($tuCurl, CURLOPT_SSLVERSION, 3);
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, false);
        if ($data) {
            curl_setopt($tuCurl, CURLOPT_POST, 1);
            curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $tuData = curl_exec($tuCurl);
        if(curl_errno($tuCurl)){
            throw new Exception('Curl error: ' . curl_error($tuCurl));
        }
        curl_close($tuCurl);
        $json = json_decode($tuData, 1);
        if (!$json) {
            return $tuData;
        }
        if ($json['error']) {
            throw new Exception(implode(',',$json['error']));
        }
        return $json;
    }
}