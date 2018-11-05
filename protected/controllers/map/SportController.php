<?php

namespace controllers\map;

use controllers\base\EventController;

class SportController extends EventController {

    public $mapTypeId = 12;

    public function getPages() {
        return [
            'Зал' => 'room'
        ];
    }

	public function actionRoom() {
		return $this->render('room');
	}

    public function actionAdd($count) {
        $count = abs($count);
        $money = Yii::$app->config->getStatPrice(2, $count, $this->user->stat->getStat(2));
        if($this->user->changeMoney(-$money)){
            $this->user->stat->addToStat(2, $count);
            $this->user->stat->save();
            $this->setUserMessage(sprintf(
                'После многих часов, проведенных в качалке,
                вы становитесь выносливее на
                <span style="color:red">%d</span> единиц.',
                $count
            ));
        }
        $this->redirect(array('room'));
    }

}