<?php
namespace behaviors\controller;

use controllers\base\EventController;
use models\Map;
use Yii;
use yii\base\Action;
use yii\base\Behavior;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.03.2018
 * Time: 9:35
 */
class MapBehavior extends Behavior {



    /**
     * {@inheritdoc}
     */
    public function attach($owner)
    {
        $this->owner = $owner;
        $owner->on(Controller::EVENT_BEFORE_ACTION, [$this, 'beforeAction']);
    }

    /**
     * {@inheritdoc}
     */
    public function detach()
    {
        if ($this->owner) {
            $this->owner->off(Controller::EVENT_BEFORE_ACTION, [$this, 'beforeAction']);
            $this->owner = null;
        }
    }

    public function beforeAction(Action $action) {
        /** @var EventController $controller */
        $controller = $action->controller;
        $x = Yii::$app->request->getQueryParam('x', false);
        $y = Yii::$app->request->getQueryParam('y', false);
        if (($x === false) || ($y === false)) {
            throw new HttpException(404, 'Не переданы координаты x, y.');
        }
        $controller->x = $x;
        $controller->y = $y;
        $map = Map::findByXY($x, $y);
        if (!$map) {
            throw new HttpException(404, 'Не найден участок с такими координатами.');
        }
        $controller->map = $map;
        if ($map->map_type_id != $controller->mapTypeId) {
            throw new HttpException(
                404,
                'Участок не принадлежит к данному типу местности: ' . $this->map->map_type_id
            );
        }
        $controller->mapType = MapType::model()->findByPk($map->map_type_id);
        if (!$controller->mapType) {
            throw new HttpException(404, 'Не найдено описание участка.');
        }
        if (!$this->user->canVisit($this->map)) {
            throw new HttpException(404, 'Участок слишком далеко от вас');
        }
    }

}