<?php

namespace models\map;

use components\Config;
use models\Price;

class MapRoom extends \models\Map {

    /**
     * @return Price
     */
    public function getRentPrice() {
        $price = new Price();
        $price->currency_id = Config::VALUTA_ID_DEFAULT;
        $price->value = $this->param2;
        return $price;
    }

    public function sentRentPrice($price) {
        $this->param2 = abs((int)$price);
        $this->save();
    }


}