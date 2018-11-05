<?php

namespace models;

use components\Config;
use components\price\PriceMerge;
use components\PriceTrait;
use models\base\BaseMapTypePeer;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "map_type".
 *
 * @property string $map_type_id
 * @property string $name
 * @property string $controller
 * @property string $info
 * @property string $params
 * @property int $markup_max
 * @property string $status
 * @property string $changed
 *
 * @property Income[] $incomes
 * @property Map[] $maps
 * @property Work[] $works
 */
class MapType extends base\BaseMapType {

    use PriceTrait;

    const OBJECT_TYPE = 'map_type';

    protected static $_models;

    public static function getModelById($id) {
        if (self::$_models === null) {
            self::$_models = ArrayHelper::map(self::find()->all(), BaseMapTypePeer::MAP_TYPE_ID, BaseMapTypePeer::MODEL);
        }
        return self::$_models[$id];
    }

    public function getAvailableTiles () {
        $return = array(0);
        for ($i = 0; $i < 100; $i++) {
            if (file_exists('images/town/mapType/tile' . $i . '.png')) {
                $return[] = $i;
            }
        }
        return $return;
    }

    public function __get($name) {
        if (substr($name,0,4)=='can_') {
            $param = substr($name, 4);
            $params = explode(',', $this->params);
            return in_array($param, $params);
        }
        return parent::__get($name);
    }

    public function image() {
        return sprintf(
            'images/town/%s/%s',
            $this->type,
            $this->image
        );
    }

    public function size() {
        $sizes = getimagesize($this->image());
        return array($sizes[0],$sizes[1]);
    }

    public function __set($name, $value) {
        if (substr($name,0,4)=='can_') {
            $param = substr($name, 4);
            $params = explode(',', $this->params);
            if ($value) {
                if (!in_array($name, $params)) {
                    $params[] = $param;
                    $this->params = implode(',', $params);
                }
            } else {
                if (in_array($name, $params)) {
                    unset($params[array_search($name, $params)]);
                    $this->params = implode(',', $params);
                }
            }
            return $value;
        }
        return parent::__set($name, $value);
    }

    public static function getParamVariants() {
        return array(
            'build'  => 'Возможность построить',
            'take'   => 'Возможность захватить',
            'update' => 'Возможность апдейтить'
        );
    }

    public function getPriceForBuild(Map $previousMap = null) {
        $currentPrice = $this->getPriceForAction(\Models\Price::ACTION_UPDATE, 1);
        if (!$previousMap) {
            return $currentPrice;
        }
        $prices = [$currentPrice];
        $prices[] = $previousMap->
            mapType->
            getPriceForBuild()->
            revert()->
            markUp(Config::MARK_UP_UNBUILD_MAP_TYPE);
        for ($level = 2; $level<=$previousMap->level; $level++) {
            $prices[] = $previousMap->
                mapType->
                getPriceForUpdate($level)->
                revert()->
                markUp(Config::MARK_UP_UNBUILD_MAP_TYPE);
        }

        return new PriceMerge(...$prices);
    }

    public function getPriceForUpdate($level) {
        return $this->getPriceForAction(\Models\Price::ACTION_UPDATE, $level);
    }

    public function getPriceIncome($level) {
        return $this->getPriceForAction(\Models\Price::ACTION_INCOME, $level);
    }
}