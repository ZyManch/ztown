<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 21.10.12
 * Time: 11:34
 */
namespace commands;

use components\Config;
use models\Course;
use models\Currency;
use yii\console\Controller;

class CurrencyController extends Controller {

    const PADDING_LEFT = 15;
    const PADDING_TOP = 10;
    const PADDING_RIGHT = 10;
    const PADDING_BOTTOM = 10;

    const NOT_UPDATE_COURSE = false;

    protected $graphWidth;
    protected $graphHeight;

    public function actionUpdate() {
        $currencies = Currency::find()->where(array('fixed_valute' => Config::NO_VALUE))->all();
        if (!self::NOT_UPDATE_COURSE) {
            $this->updateCourseOfCurrency($currencies);
        }
        $this->updateGraph($currencies);
    }

    protected function updateCourseOfCurrency($currencies) {
        foreach ($currencies as $currency) {
            /** @var Currency $currency */
            if($currency->default < $currency->course) {
                $currency->course = $currency->course * rand(98,101)/100;
            }else{
                $currency->course = $currency->course * rand(99,102)/100;
            }
            $currency->save();
            $course = new Course();
            $course->currency_id = $currency->currency_id;
            $course->price = $currency->course;
            $course->save();
        }
    }

    protected function updateGraph($currencies) {
        $this->graphWidth = Config::VALUTA_GRAPH_WIDTH - self::PADDING_LEFT - self::PADDING_RIGHT;
        $this->graphHeight = Config::VALUTA_GRAPH_HEIGHT - self::PADDING_TOP - self::PADDING_BOTTOM;
        foreach ($currencies as $currency) {
            $file = dirname(__FILE__) . '/../../images/templates/currency.png';
            $out = dirname(__FILE__) . '/../../images/download/currency'.$currency->id.'.png';
            //        left,top,right,bottom
            $im = imagecreatefrompng($file);
            imageAlphaBlending($im, false);
            imageSaveAlpha($im, true);
            $color = imagecolorallocate($im,$currency->r,$currency->g,$currency->b);
            $textColor = imagecolorallocate($im,0,0,0);
            // init points
            $crit = new CDbCriteria();
            $crit->addCondition('changed');
            $crit = new CDbCriteria();
            $crit->compare('currency_id', $currency->id);
            $crit->order = 'changed ASC';
            $points = Courses::model()->findAll($crit);
            if (!$points) {
                $course = new Courses();
                $course->price = $currency->course;
                $course->changed = date('Y-m-d H:i:s');
                $points = array($course);
            }

            // start draw graph
            $lastX = self::PADDING_LEFT;
            $lastY = $this->priceToY($points[0], $currency);
            $pointsSize = sizeof($points);
            $maxTime = $points[sizeof($points)-1]->changed(false);
            foreach ($points as $index => $course) {
                /** @var Courses $course */
                $x = $this->timeToX($course, $maxTime);
                $y = $this->priceToY($course, $currency);
                imageline($im,$lastX,$lastY,$x,$y,$color);
                imagefilledellipse($im, $x, $y, 5, 5, $color);
                if(($pointsSize-$index)%10 == 0) {
                    imagestring($im,3,$x-15,$y-12,sprintf('%.2f',$course->price),$textColor);
                }
                $lastX = $x;
                $lastY = $y;
            }
            imagepng($im,$out);
        }
    }

    protected function timeToX(Courses $course, $maxTime) {
        return self::PADDING_LEFT + $this->graphWidth -
               ($maxTime - $course->changed(false)) * $this->graphWidth / Config::VALUTA_GRAPH_WIDTH_IN_SECONDS;
    }

    protected function priceToY(Courses $course, Currency $currency) {
        return self::PADDING_TOP +
               $this->graphHeight/2 +
               2 * $this->graphHeight * ($course->price - $currency->default) / $currency->default;
    }

}