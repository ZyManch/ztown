<?php

namespace controllers\map;

use controllers\base\EventController;

class IpodromController extends EventController {

    public $mapTypeId = 9;

    public function getPages() {
        return [
            'Скачки' => 'rice'
        ];
    }

	public function actionRice() {
        Yii::$app->clientScript->registerScript(
            'ipodrom',
            sprintf(
                '
                    var tr3  = new trackbar_light("tr3","th3",%1$d,%2$d);
                    var tr6  = new trackbar_light("tr6","th6",%1$d,%2$d);
                    var tr12 = new trackbar_light("tr12","th12",%1$d,%2$d);
                ',
                round(0.1 * $this->user->getMoney()),
                $this->user->getMoney()
            )
        );
		return $this->render('rice');
	}

    public function actionRate($count) {
        $money = Yii::$app->request->getParam('money');
        $win = null;
        if ((0 < $money) && ($money < $this->user->getMoney())) {
            if ((3 <= $count) && ($count <=12) && $this->user->changeMoney(-$money)) {
                if(rand(1, $count) == 1){
                    $this->user->changeMoney($money * $count);
                    $win = true;
                    $text = sprintf('
                        После ошеломительных скачек, Вы, помимо отличных впечатлений,
                        выйграли еще %1$s. А ведь шанс был 1 к %2$s.
                    ', $money, $count);
                }else{
                    $win = false;
                    $text = sprintf('
                        После ошеломительных скачек, в результате которых вы получили
                        море впечатлений, вам даже не жалко %1$s. Ведь деньги в жизне это не главное.
                    ', $money);
                }
                $this->setUserMessage($text);
            }
        }
        return $this->render('rate', array(
            'count' => $count,
            'money' => $money,
            'win'   => $win
        ));
    }
}