<?php
Yii::import('ext.login.oauth.OAuthClient');
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 12.01.13
 * Time: 9:35
 */
class VKontakte extends OAuthClient {

    /**
     * @param $redirectUrl
     * @return string
     */
    protected function getLoginUrl($redirectUrl) {
        return sprintf(
            'http://api.vk.com/oauth/authorize?client_id=%d&redirect_uri=%s',
            Yii::$app->params->clients->vkontakte->client_id,
            urlencode($redirectUrl)
        );
    }

    public function getTokenSecret() {

    }

    public function _getUser() {

    }

    /**
     * @param $code
     * @return null|string
     */
    public function getToken() {
        $resp = file_get_contents('https://api.vk.com/oauth/token?client_id=2271023&code='.$code.'&client_secret='.$secret);
        $data = json_encode($resp, true);
        if (!$data['access_token']) {
            return null;
        }
        return $data['access_token'];
    }
}