<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $type
 * @property integer $group
 * @property integer $delonuse
 * @property Stat $stat
 * @property int $level
 * @property string $selling
 */
class Items extends ActiveRecord {

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
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content', 'required'),
			array('group, delonuse, stat_id, level', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>24),
			array('type', 'length', 'max'=>7),
			array('selling', 'length', 'max'=>11),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

    public function relations() {
        return array_merge(
            parent::relations(),
            array(
                'itemOpened' => array(self::HAS_MANY, 'ItemOpened', 'item_id')
            )
        );
    }

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