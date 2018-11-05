<?php

/**
 * This is the model class for table "maps".
 *
 * The followings are the available columns in table 'maps':
 * @property integer $id
 * @property integer $X
 * @property integer $Y
 * @property integer $map_type_id
 * @property integer $user_id
 * @property integer $roof_id
 * @property integer $street_id
 * @property integer $house
 * @property integer $LastSell
 * @property integer $markup
 * @property integer $param21
 * @property integer $level
 * @property User $parent
 * @property array $houses
 * @property Groups $mafia
 * @property MapType $mapType
 * @property MapWork[] $mapWorks
 * @property Street $street
 */
class Map extends ActiveRecord {

    const MAP_VIEW_SIZE = 4;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'map';
	}

    public function behaviors() {
        return array(
            'map' => array('class' => 'MapBehavior')
        );
    }

    const MAP_VIEW_SIZE = 4;

    public static function getMap($centerX, $centerY) {
        $mapItems = Map::model()->findAll(array(
            'condition' => 't.X BETWEEN :x - :size AND :x + :size AND t.Y BETWEEN :y - :size AND :y + :size',
            'params' => array(
                'x'    => $centerX,
                'y'    => $centerY,
                'size' => self::MAP_VIEW_SIZE
            ),
            'with' => array(
                'street',
                'mapType',
                'parent'
            )
        ));
        $grass = new Map();
        $grass->mapType = MapType::model()->findByPk(0);
        $map = self::getEmptyMap($centerX, $centerY);
        foreach ($mapItems as $mapItem) {
            $x = $mapItem->x - $centerX + self::MAP_VIEW_SIZE;
            $y = $mapItem->y - $centerY + self::MAP_VIEW_SIZE;
            $map[$x][$y] = $mapItem->toArray();
        }
        return $map;
    }

    protected static function getEmptyMap($centerX, $centerY) {

        $result = array();
        for ($x = 0; $x <= 1 + 2 * self::MAP_VIEW_SIZE; $x++) {
            for ($y = 0; $y <= 1 + 2 * self::MAP_VIEW_SIZE; $y++) {
                $grass = new Map();
                $grass->mapType = MapType::model()->findByPk(0);
                $grass->x = $x + $centerX - self::MAP_VIEW_SIZE;;
                $grass->y = $y + $centerY - self::MAP_VIEW_SIZE;;
                $result[$x][$y] = $grass->toArray();
            }

        }
        return $result;
    }

    public function toArray() {
        return array(
            'map_type_id' => $this->map_type_id,
            'street'    => 'ул.' . $this->street->name,
            'house'     => 'д.' . $this->house,
            'user_id'    => $this->user_id,
            'first_name' => $this->parent ? $this->parent->first_name : '',
            'controller'      => $this->mapType->controller,
            'name'      => $this->mapType->name,
            'type' => $this->mapType->type,
            'enabled' => \Yii::$app->user->getUser()->canVisit($this)
        );
    }

    public function isHead() {
        return $this->user_id === \Yii::$app->user->getId();
    }

    public static function findByXY($x, $y){
        $model = Map::model()->findByAttributes(array(
            'X' => $x,
            'Y' => $y
        ));
        if (is_null($model)) {
            $model = new Map();
            $model->attributes = array(
                'map_type_id' => 0,
                'user_id'   => 0,
                'X'        => $x,
                'Y'        => $y,
            );
        }
        return $model;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('X, Y, map_type_id, user_id', 'required'),
			array('X, Y, map_type_id, street_id,user_id, roof_id, house, LastSell, param2, level', 'numerical', 'integerOnly'=>true),
			array('markup', 'numerical'),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'parent' => array(self::BELONGS_TO, 'User', 'user_id'),
            'mafia'  => array(self::BELONGS_TO, 'Groups', 'roof_id'),
            'mapType'  => array(self::BELONGS_TO, 'MapType', 'map_type_id'),
            'houses' => array(self::HAS_MANY, 'Houses', 'map_id'),
            'incomes' => array(self::HAS_MANY, 'UserIncome', 'map_id'),
            'mapWorks' => array(self::HAS_MANY, 'MapWork', 'map_id'),
            'street' => array(self::BELONGS_TO, 'Street', 'street_id')
		);
	}

    /**
     * Наценка здания
     * @return float
     */
    public function getMarkUp() {
        return 1;
    }

    public function getPricesToLevelUp() {
        $prices = Config::getAllUpdateMapPrice();
        $result = array();
        foreach ($prices[$this->level] as $currency => $value) {
            $price = new Price();
            $price->currency_id = $currency;
            $price->value = -$value;
            $result[$currency] = $price;
        }
        return $result;
    }

    public function getSubLevelsToLelelUp() {
        $exps = Config::getAllUpdateMapExp();
        return $exps[$this->level];
    }

    public function getLink($text = null, $action = 'view') {
        if (is_null($text)) {
            $text = $this->mapType->name;
        }
        return Html::link(
            $text,
            array(
                 $this->mapType->controller .'/' . $action,
                 'x' => $this->x,
                 'y' => $this->y
            )
        );
    }

}