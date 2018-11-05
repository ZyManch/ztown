<?php
namespace components\price;
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 03.11.2018
 * Time: 10:30
 */
class Fake implements Contract{

    public function getMoneys() {
        return [];
    }

    public function revert() {
        return $this;
    }

    public function markUp($markUp) {
        return $this;
    }


}