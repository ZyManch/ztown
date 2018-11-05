<?php

namespace models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $item_id
 * @property string $name
 * @property string $type
 * @property string $group
 * @property string $delonuse
 * @property string $stat_id
 * @property string $level
 * @property string $selling
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property Stat $stat
 * @property ItemBuied[] $itemBuieds
 * @property ItemOpened[] $itemOpeneds
 */
class Item extends base\BaseItem {

    // 'stat1' => 'Интеллект',
    CONST STAT_INT = 1;
    // 'stat2' => 'Выносливость',
    CONST STAT_HP = 2;
    // 'stat3' => 'Защита',
    CONST STAT_DEF = 3;
    // 'stat4' => 'Атака',
    CONST STAT_ATC = 4;
    // 'stat5' => 'Ловкость',
    CONST STAT_AGL = 5;
    // 'stat6' => 'Авторитет',
    CONST STAT_POP = 6;

    const SELLING_SHOP = 'shop';
    const SELLING_SHOP_OPENED = 'shop_opened';
    const SELLING_NEVER = 'never';

    const TYPE_GLASS = 'glass';
    const TYPE_HELMET = 'helmet';
    const TYPE_WEAPON = 'weapon';
    const TYPE_GLOVES = 'gloves';
    const TYPE_DRESS = 'dress';
    const TYPE_BOTS = 'bots';
    const TYPE_NECKLACE = 'necklace';
    const TYPE_RING = 'ring';

    const EQUIPPED_TYPES = [
        self::TYPE_GLASS,
        self::TYPE_HELMET,
        self::TYPE_WEAPON,
        self::TYPE_GLOVES,
        self::TYPE_DRESS,
        self::TYPE_BOTS,
        self::TYPE_NECKLACE,
        self::TYPE_RING
    ];


    public static function statLabels($statId) {
        switch ($statId) {
            case 1: return 'Интеллект';    break;
            case 2: return 'Выносливость'; break;
            case 3: return 'Защита';       break;
            case 4: return 'Атака';        break;
            case 5: return 'Ловкость';     break;
            case 6: return 'Авторитет';   break;
            default: return '';
        }
    }
}