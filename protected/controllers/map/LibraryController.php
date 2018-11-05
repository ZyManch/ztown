<?php

namespace controllers\map;

use controllers\base\EventController;

class LibraryController extends EventController {

    public $mapTypeId = 10;

    public function getPages() {
        return [
            'Библиотека' => 'read'
        ];
    }


	public function actionRead() {
		return $this->render('read');
	}

    public function actionAdd($count) {
        $count = abs($count);
        $money = Yii::$app->config->getStatPrice(1, $count, $this->user->stat);
        if($this->user->changeMoney(-$money)){
            $this->user->stat->addToStat(1, $count);
            $this->user->stat->save();
            $this->setUserMessage(sprintf(
                'Потратив несколько часов на изучение книг,
                аренду которых вы оплатили, вы стали на
                <span style="color:red">%d</span> единиц интеллекта умнее.',
                $count
            ));
        }
        $this->redirect(array('read'));
    }
}