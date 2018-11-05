<?php

namespace models\map;

use components\Config;

class MapCrop extends \models\Map {


    public function secondsToHarvest() {
        return max(0, strtotime($this->changed) + Config::CROP_HARVEST_TIME - time());
    }

    public function timeToHarvest() {
        $seconds = $this->secondsToHarvest();
        $hours = floor($seconds/3600);
        $minutes = floor($seconds/60)%60;
        $seconds = $seconds%60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}