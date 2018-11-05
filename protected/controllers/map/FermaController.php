<?php

namespace controllers\map;

use controllers\base\EventController;
use models\Map;

class FermaController extends EventController {

    public $mapTypeId = 1;

    public function getPages() {
        return [
            'Посев'      => 'land',
            'Склад'      => 'storage',
        ];
    }

    public function actionLand() {
        return $this->render('land');
    }

    public function actionStorage() {
        return $this->render('storage');
    }

    public function actionHarvest($map_id) {
        try {
            if (!$this->map->isOwner($this->user)) {
                throw new \Exception('Вы не можете собирать урожай не на своей ферме');
            }
            $map = Map::findOne((int)$map_id);
            if (!$map || $this->map->map_id !== $map->parent_map_id) {
                throw new \Exception('Посев не принадлежит данной ферме');
            }
            $this->user->getStorage()->spendMoney($map->mapType->getPriceIncome(), $this->map->map_id);
            $map->changed = date('Y-m-d H:i:s');
            $map->save();
            $this->setUserMessage('Урожай успешно собран');
        } catch (\Exception $e) {
            $this->setUserMessage($e->getMessage());
        }
        $this->redirect(['land']);
    }

}