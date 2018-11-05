<?php

namespace controllers\map;

use components\Config;
use components\Date;
use controllers\base\EventController;
use models\House;
use models\map\MapRoom;

/**
 * Class RoomController
 * @package controllers\map
 * @property MapRoom $map
 */
class RoomController extends EventController {

    public $mapTypeId = 5;

    public function actionView() {
        $houses = $this->map->houses;
        return $this->render('view', array('houses' => $houses,'map'=>$this->map));
    }

    public function actionBuy() {
        if (count($this->map->houses) >= Config::MAX_HOUSE_LIVE) {
            $this->setUserMessage('Дом переполнен');
        } else if ($this->user->spendMoneyByPrices($this->map->getRentPrice())) {
            $house = new House();
            $house->map_id = $this->map->map_id;
            $house->user_id = $this->user->user_id;
            $house->last_pay = Date::db();
            $house->save();
            $this->map->getRentPrice()->addToUser($this->map->user);
            $this->setUserMessage('Покупка удачно совершена');
        } else {
            $this->setUserMessage('Недостаточно денег для покупки');
        }
        $this->redirect(array('view'));
    }

    public function actionSell() {
        $user = \Yii::$app->user->getUser();
        $house = House::find()->where(array(
            'map_id' => $this->map->id,
            'user_id' => $user->id
        ))->one();
        if (is_null($house)) {
            $this->setUserMessage('Перед продажей чего-то, надо хотябы это иметь.');
        } else {
            foreach ($house->userIncome as $userIncome) {
                $userIncome->delete();
            }
            $house->delete();
            $user->spendMoneyByItem($this->mapType, -1);
            $this->setUserMessage('Продажа успешно осуществлена.');
        }
        $this->redirect(array('view'));
    }
}