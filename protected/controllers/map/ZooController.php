<?php

namespace controllers\map;

use controllers\base\EventController;

class ZooController extends EventController {

    public $mapTypeId = 16;

    public function getPages() {
        return [
                'Беговые'     => 'horse',
                'Боевые'      => 'dog',
        ];
    }

    public function actionHorse() {
        return $this->render('list', array(
            'type' => 'horse',
            'items' => $this->_getItems('horse')
        ));
    }

    public function actionDog() {
        return $this->render('list', array(
            'type' => 'dog',
            'items' => $this->_getItems('dog')
        ));
    }

    public function _getItems($type) {
        $criteria = new CDbCriteria();
        $criteria->with = array('stat','price');
        $criteria->compare('t.type', $type);
        $criteria->addCondition('t.level <= :level');
        $criteria->params[':level'] = $this->map->level;
        $criteria->index = 'id';
        $items = Animal::model()->findAll($criteria);
        //var_dump($items);die();
        return $items;
    }

    public function actionBuy($type, $id) {
        $items = $this->_getItems($type);
        if (!isset($items[$id])) {
            throw new CHttpException(404, 'Item not find');
        }
        if ($this->user->horse) {
            throw new CHttpException(404, 'У вас уже есть лошадь.');
        }
        $item = $items[$id];
        if (!$this->user->spendMoneyByItem($item, $this->getMarkUp())) {
            throw new CHttpException(404, 'Недостаточно средств');
        }
        $stat = new Stat();
        $stat->joinStat($item->stat);
        $stat->save();
        $userAnimal = new UserAnimal();
        $userAnimal->setAttributes(array(
            'animal_id' => $id,
            'user_id' => $this->user->id,
            'stat_id' => $stat->id
        ));
        if (!$userAnimal->save()) {
            throw new Exception($userAnimal);
        }
        $this->setUserMessage('<img src="images/info/shop.jpg"><br>Спасибо за покупку. Прихотите к нам еще раз.');
        $this->redirect(array(strtolower($item->type)));
    }
}