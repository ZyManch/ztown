<?php
namespace controllers\base;

use models\Map;
use models\MapType;
use models\MapWork;
use Yii;
use yii\helpers\Url;
use yii\web\HttpException;

/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 08.06.12
 * Time: 8:41
 * To change this template use File | Settings | File Templates.
 */
class EventController extends Controller {

    public $x;
    public $y;
    public $mapTypeId = 0;
    public $layout='columnTabs';

    /**
     * @var MapType
     */
    public $mapType = null;
    /**
     * @var Map
     */
    public $map = null;

    public function getPages() {
        return [];
    }

    public function beforeAction($action) {
        $this->x = Yii::$app->request->get('x', false);
        $this->y = Yii::$app->request->get('y', false);
        if (($this->x === false) || ($this->y === false)) {
            throw new HttpException(404, 'Не переданы координаты x, y.');
        }
        $this->map = Map::findByXY($this->x, $this->y);
        if (!$this->map) {
            throw new HttpException(404, 'Не найден участок с такими координатами.');
        }
        if ($this->mapTypeId && $this->map->map_type_id != $this->mapTypeId) {
            throw new HttpException(
                404,
                'Участок не принадлежит к данному типу местности: ' . $this->map->map_type_id
            );
        }
        $this->mapType = MapType::findOne($this->map->map_type_id);
        if (!$this->mapType) {
            throw new HttpException(404, 'Не найдено описание участка.');
        }
        if (!$this->user->canVisit($this->map)) {
            throw new HttpException(404, 'Участок слишком далеко от вас');
        }
        return parent::beforeAction($action);
    }


    public function actionView() {
        $this->view->registerJsFile('/js/smartslider.js');
        $this->view->registerCssFile('/css/smartslider.css');
        return $this->render('//map/event/info', array(
            'mapType'  => $this->mapType,
            'map'    => $this->map
        ));
    }

    public function actionMarkUp($markUp) {
        if ($this->map->parent->id != $this->user->user_id) {
            throw new HttpException(404, 'Вы не являетесь владельцем');
        }
        $markUp = min(max(0, $markUp), $this->mapType->markup_max);
        $this->map->markup = $markUp;
        $this->map->save();
    }

    public function actionUpgrade() {
        try {
            if (!$this->map->isOwner($this->user)) {
                throw new \Exception('Надо быть владельцем для смены типа здания');
            }
            if ($this->map->hasMaxLevel()) {
                throw new HttpException(404, 'Здание уже максимально улучшено');
            }
            $price = $this->map->mapType->getPriceForUpdate($this->map);
            if (!$this->user->getStorage()->spendMoney($price)) {
                throw new \Exception('Недостаточно денег на покупку');
            }
            $this->map->level++;
            $this->map->save();
            $this->setUserMessage('Здание успешно улучшено');
        } catch (\Exception $e) {
            $this->setUserMessage($e->getMessage());
        }
        $this->redirect(['view']);
    }

    public function actionDoWork($id) {
        /** @var MapWork $mapWork */
        $mapWork = MapWork::model()->findByPk($id);
        if ($mapWork && $this->user->spendMoneyByItem($mapWork->work->workBonus)) {
            $mapWork->count--;
            if ($mapWork->count == 0) {
                $mapWork->delete();
            } else {
                $mapWork->save();
            }
            $this->map->sub_level+=$mapWork->work->workBonus->add_sub_levels;
            $this->map->save();
        }
        $this->redirect(array('view'));
    }

    public function actionAddWork($id = null, $count = 1) {
        if ($this->map->parent->id != $this->user->user_id) {
            throw new HttpException(404, 'Вы не являетесь владельцем');
        }
        if ($id) {
            /** @var Work $work */
            $work = Work::model()->findByPk($id);
            $count = (int)$count;
            if ($work && $count > 0 && $this->user->spendMoneyByItem($work, $count)) {
                $mapWork = MapWork::model()->findByAttributes(array(
                    'map_id' => $this->map->id,
                    'work_id' => $work->id
                ));
                if (!$mapWork) {
                    $mapWork = new MapWork();
                    $mapWork->map_id = $this->map->id;
                    $mapWork->work_id = $work->id;
                }
                $mapWork->count+=$count;
                if(!$mapWork->save()) {
                    throw new HttpException(404, 'Ошибка подачи обьявления о работе:'.implode(',', array_values($mapWork->errors)));
                }
                $this->setUserMessage('Обьявления о работе поданы. Ожидайте их выполнения подрдчиками.');
            }
        }

        return $this->render('//map/event/addWork',array(
            'works' => Work::model()->with('workBonus')->findAll()
        ));

    }

    public function actionRebuy() {
        if ($this->map->parent->id == $this->user->user_id) {
            throw new HttpException(404, 'Вы уже являетесь владельцем');
        }
        if ($this->user->spendMoneyByItem($this->mapType, $this->map->getMarkUp())) {
            $this->map->saveAttributes(array(
                'user_id' => $this->user->user_id
            ));
            $this->afterBuy();
        }
        $this->redirect(array('view'));
    }

    protected function afterBuy() {

    }


    public function getUrl($action, $params=array()) {
        if (strpos($action, '/') === false) {
            $action = $this->mapType->controller.'/'.$action;
        }
        return Url::to(
            array_merge(
                array(
                    $action,
                    'x' => $this->x, 'y' => $this->y
                ),
                $params
            )
        );
    }

    /**
     * Наценка заведения
     * @return float
     */
    public function getMarkUp() {
        return 1 + $this->map->markup/100;
    }

    public function redirect($url, $statusCode = 302) {
        if (is_array($url)) {
            $action = array_shift($url);
            if (strpos($action, '/') === false) {
                $action = $this->mapType->controller.'/'.$action;
            }
            $url = array_merge(
                array(
                    $action,
                    'x' => $this->x, 'y' => $this->y
                ),
                $url
            );
        }
        parent::redirect($url, $statusCode);
    }

    public function render($view, $data = []) {
        $data = array_merge(
            ['map' => $this->map, 'mapType' => $this->mapType],
            is_array($data) ? $data : array()
        );
        return parent::render($view, $data);
    }

    public function getViewFolder() {
        return 'map';
    }

}