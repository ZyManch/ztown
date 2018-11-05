<?php

namespace controllers\map;

use controllers\base\EventController;

class ShopController extends EventController {

    public $mapTypeId = 2;

    public function getPages() {
        return [
            'Очки'       => 'glass',
            'Шапка'      => 'helmet',
            'Перчатки'   => 'gloves',
            'Костюм'     => 'dress',
            'Обувь'      => 'bots',
            'Цепочка'    => 'neclase',
            'Печатка'    => 'ring'
        ];
    }

    public function actionGlass() {
        return $this->render('list', array(
            'type' => 'Glass',
            'items' => $this->_getItems('Glass')
        ));
    }

    public function actionHelmet() {
        return $this->render('list', array(
            'type' => 'Helmet',
            'items' => $this->_getItems('Helmet')
        ));
    }

    public function actionGloves() {
        return $this->render('list', array(
            'type' => 'Gloves',
            'items' => $this->_getItems('Gloves')
        ));
    }

    public function actionDress() {
        return $this->render('list', array(
            'type' => 'Dress',
            'items' => $this->_getItems('Dress')
        ));
    }

    public function actionBots() {
        return $this->render('list', array(
            'type' => 'Bots',
            'items' => $this->_getItems('Bots')
        ));
    }

    public function actionNeclase() {
        return $this->render('list', array(
            'type' => 'Neclase',
            'items' => $this->_getItems('Neclase')
        ));
    }

    public function actionRing() {
        return $this->render('list', array(
            'type' => 'Ring',
            'items' => $this->_getItems('Ring')
        ));
    }

    public function _getItems($type) {
        $criteria = new CDbCriteria();
        $criteria->with = array('itemOpened','stat','price');
        $criteria->compare('itemOpened.user_id', $this->user->id);
        $criteria->compare('t.type', $type);
        $criteria->addCondition('t.level <= :level');
        $criteria->params[':level'] = $this->map->level;
        $criteria->index = 't.id';
        $items = Items::model()->findAll($criteria);

        $shopItems = Items::model()->
            with(array('stat','price'))->
            findAllByAttributes(array('type'=>$type));
        foreach ($shopItems as $item) {
            if ($item->level <= $this->map->level) {
                $items[$item->id] = $item;
            }
        }
        return $items;
    }

    public function actionBuy($type, $id) {
        $items = $this->_getItems($type);
        if (!isset($items[$id])) {
            throw new CHttpException(404, 'Item not find');
        }
        $item = $items[$id];
        if (!$this->user->spendMoneyByItem($item, $this->getMarkUp())) {
            throw new CHttpException(404, 'Недостаточно средств');
        }
        $stat = new Stat();
        $stat->joinStat($item->stat);
        $stat->save();
        $itemBuied = new ItemBuied();
        $itemBuied->setAttributes(array(
            'item_id' => $id,
            'user_id' => $this->user->id,
            'stat_id' => $stat->id
        ));
        $itemBuied->save();
        $this->setUserMessage('<img src="images/info/shop.jpg"><br>Спасибо за покупку. Прихотите к нам еще раз.');
        $this->redirect(array(strtolower($item->type)));
    }
}