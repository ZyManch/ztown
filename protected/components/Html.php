<?php
namespace components;
use yii\helpers\Url;

/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 08.07.12
 * Time: 11:49
 * To change this template use controller | Settings | File Templates.
 */
class Html extends \yii\helpers\Html {

    /**
     * @param $label
     * @param $img
     * @param $url
     * @param array $htmlOptions
     * @return string
     */
    public static function buttonWithHref($label, $img, $url, $htmlOptions = array()) {
        $htmlOptions['href'] = $url;
        return self::buttonWithImage($label, $img, $htmlOptions);
    }

    public static function buttonWithImage($label, $img, $htmlOptions = array()) {
        if ($img) {
            $label = self::img($img) . ' ' . $label;
        }
        if (isset($htmlOptions['href'])) {
            $url = $htmlOptions['href'];
            if (is_array($url)) {
                $url = Url::to($url);
            }
            $htmlOptions['onclick'] = 'location.href=\''.$url.'\';return false;';
            unset($htmlOptions['href']);
        }
        return self::button($label, $htmlOptions);
    }


    public static function moneyButtonByPrices($label, $img, $price, $htmlOptions = array()) {
        $view = new View();
        $label .= ' ' . $view->
            render('//users/_price', array('price' => $price));
        if (!\Yii::$app->user->getIdentity()->getStorage()->canBuy($price)) {
            $htmlOptions['disabled'] = 'disabled';
        }
        return self::buttonWithImage($label, $img, $htmlOptions);
    }
}