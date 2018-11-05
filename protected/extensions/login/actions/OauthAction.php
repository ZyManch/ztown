<?php
Yii::import('ext.login.actions.OauthAbstract');
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 19.01.13
 * Time: 7:29
 */
class OauthAction extends CAction {


    const DURATION = 31536000; // 3600 * 24 * 365
    /** @var OAuthClient  */
    protected $_oauth = null;

    protected $_availableOauth = array(
        'twitter' => 'ext.login.oauth.Twitter',
        'vk'      => 'ext.login.oauth.VKontakte',
        'facebook'=> 'ext.login.oauth.Facebook',
    );

    public function __construct($controller, $id) {
        parent::__construct($controller, $id);
        $id = Yii::$app->request->getParam('id');
        if (!in_array($id, array_keys($this->_availableOauth))) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $className = Yii::import($this->_availableOauth[$id]);
        $this->_oauth = new $className();
    }

    public function run() {
        if ($this->_oauth->isAuthCodeReturned()) {
            if (!$this->_oauth->authenticate()) {
                throw new CHttpException('Error on login, try again');
            }
            if (Yii::$app->user->login($this->_oauth, self::DURATION)) {
                $this->_oauth->getUser()->setViewPage(
                    CHtml::normalizeUrl(array('register/oauth')),
                    UserViewPage::COUNT_ALWAYS
                );
            }
            $this->_oauth->saveSession();
            $this->controller->redirect($this->_oauth->getRedirectOnSuccessLogin());
        } else {
            $this->_oauth->showLoginPage();
        }
    }
}