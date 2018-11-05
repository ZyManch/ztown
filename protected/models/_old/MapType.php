<?php

/**
 * This is the model class for table "mapTypes".
 *
 * The followings are the available columns in table 'mapTypes':
 * @property integer $id
 * @property string $controller
 * @property string $name
 * @property string $info
 * @property string $params
 * @property integer $can_build
 * @property integer $can_take
 * @property integer $can_update
 * @property integer $can_markup
 * @property integer $markup_max
 * @property Stat $stat
 * @property Price $price
 * @property Income $income
 * @property UserIncome $userIncome
 */
class MapType extends ActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'map_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        return array(
            array('controller, name, info', 'required'),
            array('markup_max', 'numerical',
                'integerOnly'=> true),
            array('controller', 'length', 'max'=> 8),
            array('name', 'length', 'max'=> 32),
            array('params', 'safe'),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
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

    public function image($state = '') {
        return sprintf(
            'images/town/%s/tile%d%s.png',
            $this->type,
            $this->id,
            $state ? '_'.$state : ''
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

}