<?php

namespace models;

use components\Config;
use components\Html;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "map".
 *
 * @property string $map_id
 * @property string $map_type_id
 * @property string $x
 * @property string $y
 * @property string $user_id
 * @property string $street_id
 * @property string $roof_id
 * @property string $house
 * @property string $last_sell
 * @property string $param2
 * @property string $level
 * @property string $markup
 * @property string $status
 * @property string $changed
 *
 * @property House[] $houses
 * @property MafiaInfo[] $mafiaInfos
 * @property MapType $mapType
 * @property User $roof
 * @property Street $street
 * @property User $user
 * @property MapWork[] $mapWorks
 */
class Map extends base\BaseMap {

    public function isHead() {
        return $this->user_id === \Yii::$app->user->getId();
    }

    public static function findByXY($x, $y){
        $model = Map::find()->
            where('x=:x and y=:y',array(':x' => $x,':y' => $y))->
            one();
        if (is_null($model)) {
            $model = new Map();
            $model->map_type_id = 0;
            $model->user_id  = 0;
            $model->x        = $x;
            $model->y        = $y;
            $model->param2   = 0;
            $model->markup   = 0;
        }
        return $model;
    }


    /**
     * Наценка здания
     * @return float
     */
    public function getMarkUp() {
        return 1;
    }

    public function getPricesToLevelUp() {
        $prices = Config::getAllUpdateMapPrice();
        $result = array();
        foreach ($prices[$this->level] as $currency => $value) {
            $price = new Price();
            $price->currency_id = $currency;
            $price->value = -$value;
            $result[$currency] = $price;
        }
        return $result;
    }

    public function getSubLevelsToLelelUp() {
        $exps = Config::getAllUpdateMapExp();
        return $exps[$this->level];
    }

    public function getLink($text = null, $action = 'view') {
        if (is_null($text)) {
            $text = $this->mapType->name;
        }
        return Html::a(
            $text,
            $this->getUrl($action)
        );
    }

    public function getUrl($action, $params = []) {
        return Url::to(array_merge([
            $this->mapType->controller .'/' . $action,
            'x' => $this->x,
            'y' => $this->y
        ],$params));
    }

    public function getPrices() {
        return Price::find()->where([
            'object_id' => $this->map_id,
            'object_type' => 'map'
        ])->all();
    }

    public function hasMaxLevel() {
        return $this->level == $this->mapType->level_max;
    }


    public static function instantiate($row)
    {
        $model = MapType::getModelById($row['map_type_id']);
        if (!$model) {
            return new self();
        }
        $class = '\\models\\map\\Map'.ucfirst($model);
        if (!class_exists($class)) {
            throw new \Exception('Unknown map model "'.$model.'" for '.$row['map_type_id']);
        }
        return new $class();
    }

    public function isOwner(User $user) {
        if ($this->user_id == $user->user_id) {
            return true;
        }
        if (!$this->parent_map_id) {
            return false;
        }
        if ($this->parentMap->user_id == $user->user_id) {
            return true;
        }
        return false;
    }
}