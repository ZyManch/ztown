<?php

namespace models\map;

use components\Config;
use models\Price;

class MapStorage extends \models\Map {


    public function getMaxWeight() {
        return $this->level*100;
    }

    public function getCurrentWeight() {
        $result = 0;
        foreach ($this->parentMap->moneys as $money) {
            $result+=$money->value*$money->currency->weight;
        }
        return $result;
    }


}