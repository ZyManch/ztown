<?php
namespace components;
use models\ItemBuied;

/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 06.05.12
 * Time: 21:54
 * To change this template use File | Settings | File Templates.
 */
class Date {
    /**
     * Дата начала игры
     */
    const START_TIME = 1336330493;
    /**
     * Скорость игры
     */
    const GAME_SPEED = 1;

    protected static $curTime;

    /**
     * Текущее время игры
     * @return int
     */
    public static function timestamp($time = false) {
        if($time || !self::$curTime) {
            $curTime = $time ? $time : time();
            $curTime = self::START_TIME + self::GAME_SPEED * ($curTime - self::START_TIME);
            if (!$time) {
                self::$curTime = $curTime;
            }
            return $curTime;
        }
        return self::$curTime;
    }

    public static function db($time = false) {
        return date('Y-m-d H:i:s',self::timestamp($time));
    }

}