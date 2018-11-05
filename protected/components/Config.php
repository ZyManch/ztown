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
class Config {

    /**
     * Соощений на странице
     */
    const MESSAGES_IN_PAGE = 20;
    /**
     * Друзей на странице
     */
    const FRIENDS_IN_PAGE = 20;

    /**
     * Логов на странице
     */
    const REPORTS_IN_PAGE = 20;

    /**
     * Коэфициент стоимости стандартного апа вещей
     */
    const UPGRADE_COEF_ADVANCED = 1.3;

    /**
     * Коэфициент стоимости вип апа вещей
     */
    const UPGRADE_COEF_VIP = 1.35;

    /**
     * Коэфициент стоимости голд апа вещей
     */
    const UPGRADE_COEF_GOLD = 1.4;

    /**
     * Максимальное количество человек проживающие в 1 доме
     */
    const MAX_HOUSE_LIVE = 3;

    const MAX_UPDATE_BUILD_LEVEL = 20;

    /**
     * Секунд между сменой курса валют
     */
    const VALUTA_UPDATE_DELAY = 5;

    /**
     * Валюта по умолчанию
     */
    const VALUTA_ID_DEFAULT = 2;

    /**
     * Размеры графика по валютам
     */
    const VALUTA_GRAPH_WIDTH = 599;
    const VALUTA_GRAPH_HEIGHT = 238;
    const VALUTA_GRAPH_WIDTH_IN_SECONDS = 10800;

    /**
     * Ждать секунд между битвами
     */
    const ARENA_DELAY = 60;
    /**
     * Enum значения
     */
    const YES_VALUE = 'Yes';
    const NO_VALUE = 'No';
    /**
     * Стандартная стата у армии
     */
    const ARMY_STAT_DEFAULT = 10;
    /**
     * Стоимость найма армии
     */
    const ARMY_PRICE = 100;

    /**
     * Юзер онлайн если менее стольки секунд он заходил на сайт
     */
    const USER_ONLINE_DELAY = 300;

    /**
     * Сколько переплачивает юзер при перепокупке чужого заведения
     */
    const MAP_REBAY = 1.2;

    const PASSWORD_SALT = 'qwe7j&j=';

    const MARK_UP_UNBUILD_MAP_TYPE = 0.5;

    const CROP_HARVEST_TIME = 600;


    public static function getAllStatPrices($user = null) {
        return array(
            1 => array(
                1 => 100,
                5 => 510,
                10 => 1100
            ),
            2 => array(
                1 => 100,
                5 => 510,
                10 => 1100
            ),
            3 => array(
                1 => 100,
                5 => 510,
                10 => 1100
            ),
            4 => array(
                1 => 100,
                5 => 510,
                10 => 1100
            ),
            5 => array(
                1 => 100,
                5 => 510,
                10 => 1100
            )
        );
    }

    public static function getMoneyOnRegister() {
        return array(
            3 => 1000,
            4 => 100
        );
    }

    /**
     * Стоимость апа статы
     * @param $statId
     * @param $count
     * @param null $fromStat
     * @return int
     */
    public static function getStatPrice($statId, $count, $fromStat = null) {
        $allStats = self::getAllStatPrices(\Yii::$app->user->identity);
        $allStats = $allStats[$statId];
        if (is_null($fromStat)) {
            $statName = 'Stat' . $statId;
            $fromStat = \Yii::$app->user->identity->$statName;
        }
        if (isset($allStats[$count])) {
            return $allStats[$count] * $fromStat;
        }
        $allStats = array_reverse($allStats, true);
        foreach ($allStats as $add => $money) {
            if ($add <= $count) {
                return $money * $fromStat + self::getStatPrice($statId, $count - $add, $fromStat + $add);
            }
        }
        return 0;
    }

    /**
     * Стоимость апгрейда
     * @param ItemBuied $item
     * @param $light
     * @return int
     */
    public static function getUpgradePrice(ItemBuied $item, $light) {
        $coefs = array(
            ItemBuied::UPGRADE_ADVANCED => self::UPGRADE_COEF_ADVANCED,
            ItemBuied::UPGRADE_VIP      => self::UPGRADE_COEF_VIP,
            ItemBuied::UPGRADE_GOLD     => self::UPGRADE_COEF_GOLD
        );
        $result = array();
        foreach($item->item->price as $price) {
            $price = clone $price;
            /** @var $price Price  */
            $price->value = $price->value * pow($coefs[$light], $item->level + 1) - $price->value;
            $result[] = $price;
        }
        return $result;
    }

    /** Сколько sub_level надо для +1 level */
    public static function getAllUpdateMapExp() {
        return array(
            0 => 20,
            1 => 50,
            2 => 100,
            3 => 200,
            4 => 400,
            5 => 600,
            6 => 1000,
            7 => 1500,
            8 => 2500,
            9 => 4000,
            10=> 7000,
            11=> 10000,
            12=> 13000,
            13=> 17000,
            14=> 21000,
            15=> 28000,
            16=> 33000,
            17=> 40000,
            18=> 50000,
            19=> 100000
        );
    }

    public static function getAllUpdateMapPrice() {
        return array(
            0 => array(5 => 10, 6 => 10),
            1 => array(5 => 30, 6 => 20),
            2 => array(5 => 50, 6 => 30),
            3 => array(13 => 50, 8 => 50),
            4 => array(13 => 100, 8 => 50),
            5 => array(14 => 150, 8 => 100),
            6 => array(14 => 200, 8 => 200),
            7 => array(15 => 350, 8 => 300),
            8 => array(15 => 450, 8 => 350),
            9 => array(15 => 600, 8 => 450),
            10=> array(15 => 850, 8 => 550),
            11=> array(7 => 1000, 8 => 1000),
            12=> array(7 => 1400, 8 => 1400),
            13=> array(7 => 2000, 8 => 2000),
            14=> array(7 => 3000, 8 => 3000),
            15=> array(7 => 5000, 8 => 5000),
            16=> array(7 => 7000, 8 => 7000),
            17=> array(7 => 10000, 8 => 10000),
            18=> array(7 => 12000, 8 => 12000),
            19=> array(7 => 15000, 8 => 15000)
        );
    }



    /**
     * Денежный выйгрыш победителя при одиночном бое
     * @param $lvl
     * @return int
     */
    public static function getSingleWinPrice($lvl) {
        return ($lvl+rand(-5, 5)/10)*150;
    }

    /**
     * Опыт победителя при одиночном бое
     * @param $lvl
     * @return int
     */
    public static function getSingleWinExp($lvl) {
        return round(max(1, $lvl+rand(-2, 2))*3);
    }

    /**
     * Сколько надо набрать опыта чтобы получить лвл
     * @param $lvl
     * @return int
     */
    public static function getExpToLvl($lvl) {
        return round(($lvl-1) * $lvl / 2);
    }

    /**
     * HP
     * @param $stat2
     * @return int
     */
    public static function getHp($stat2) {
        return $stat2 * 10;
    }

    /**
     * Шанс попадания
     * @param $stat5From
     * @param $stat5To
     * @return float
     */
    public static function getChanceHit($stat5From, $stat5To) {
        $stat5To = max(1, $stat5To);
        $stat5From = max(1, $stat5From);
        return min(max(0.2, $stat5To/$stat5From), 0.7) + 0.1;
    }

    /**
     * Шанс крита
     * @param $stat5From
     * @param $stat5To
     * @return float
     */
    public static function getChanceKrit($stat5From, $stat5To) {
        $stat5To = max(1, $stat5To);
        $stat5From = max(1, $stat5From);
        return min(max(0.2, $stat5To/$stat5From), 0.7) - 0.2;
    }

    /**
     * Урон
     * @param $stat4From
     * @param $stat3To
     * @return float
     */
    public static function getDamage($stat4From, $stat3To) {
        $damage = rand($stat4From*7, $stat4From*13)
                 -rand($stat3To*5, $stat3To*10);
        return round(max($damage/10, 1));
    }
}