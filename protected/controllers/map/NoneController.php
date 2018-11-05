<?php

namespace controllers\map;

use controllers\base\EventController;
use models\MapType;
use yii\helpers\Url;

class NoneController extends EventController {

    public $mapTypeId = 0;

    /** @var MapType[] */
    public $mapTypes = [];

    public function beforeAction($action) {
        $result = parent::beforeAction($action);
        $mapType = $this->map->mapType;
        if ($mapType->build_type_id) {
            $mapType = $mapType->buildType;
        }
        $this->mapTypes[$mapType->map_type_id] = $mapType;
        foreach ($mapType->mapTypes as $childMapType) {
            $this->mapTypes[$childMapType->map_type_id] = $childMapType;
        }
        return $result;
    }

    public function getPages() {
        if (!$this->map->parent_map_id) {
            return [];
        }
        return [
            'Главное здание' => $this->map->parentMap->getUrl('view'),
        ];
    }


    public function actionView() {
        if (!$this->map->isOwner($this->user)) {
            $this->redirect(Url::to('maps/index'));
        }
		return $this->render('view', array(
            'mapTypes' => $this->mapTypes
        ));
	}

    public function actionBuild($map_type_id) {
        try {
            if (!$this->map->isOwner($this->user)) {
                throw new \Exception('Надо быть владельцем для смены типа здания');
            }
            $map_type_id = (int)$map_type_id;
            if (!isset($this->mapTypes[$map_type_id])) {
                throw new \Exception('Здание не может быть построено');
            }
            $newMapType = $this->mapTypes[$map_type_id];
            if ($newMapType->map_type_id == $this->map->map_type_id) {
                throw new \Exception('Такой тип здания уже построен');
            }
            $price = $newMapType->getPriceForBuild($this->map);
            if (!$this->user->getStorage()->spendMoney($price)) {
                throw new \Exception('Недостаточно денег на покупку');
            }
            $this->map->map_type_id = $newMapType->map_type_id;
            $this->map->save();
        } catch (\Exception $e) {
            $this->setUserMessage($e->getMessage());
        }
        $this->redirect(array('view'));
    }

}