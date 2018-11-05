<?php

namespace models\map;

use components\Config;
use models\Price;

class MapFerma extends \models\Map {

    /**
     * @return MapCrop[]
     */
    public function getLands() {
        $result = [];
        foreach ($this->maps as $map) {
            if ($map instanceof MapCrop) {
                $result[] = $map;
            }
        }
        return $result;
    }

    /**
     * @return MapStorage|null
     */
    public function getStorage() {
        foreach ($this->maps as $map) {
            if ($map instanceof MapStorage) {
                return $map;
            }
        }
        return null;
    }


}