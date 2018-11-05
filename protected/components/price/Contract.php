<?php
namespace components\price;
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 03.11.2018
 * Time: 10:30
 */
interface Contract {

    /**
     * @return float[]
     */
    public function getMoneys();

    /**
     * @return static
     */
    public function revert();

    /**
     * @param $markUp
     * @return static
     */
    public function markUp($markUp);

}