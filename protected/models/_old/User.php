<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $access
 * @property string $first_name
 * @property string $last_name
 * @property integer $sex
 * @property integer $Banned
 * @property string $email
 * @property string $password
 * @property integer $group_id
 * @property string $group_info
 * @property integer $Gold
 * @property Stat $stat
 * @property integer $level
 * @property integer $exp
 * @property string $info
 * @property integer $X
 * @property integer $Y
 * @property integer $last_visit
 * @property integer $last_count
 * @property integer $page_loaded
 * @property string $avatar
 * @property string $lang
 * @property Groups $group
 * @property Items[] $weaponsOpened
 * @property Items[] $glassesOpened
 * @property Items[] $helmetsOpened
 * @property Items[] $glovesesOpened
 * @property Items[] $dressesOpened
 * @property Items[] $botsOpened
 * @property Items[] $neclasesOpened
 * @property Items[] $ringsOpened
 * @property array $army
 * @property array $friends
 * @property array $itemsUsed
 * @property Friends $family
 * @property int $energy
 * @property int $energy_max
 * @property int $energy_date
 * @property array $income
 * @property int $stat_id
 * @property UserViewPage[] $viewPages
 * @property UserCanChangeName $canChangeName
 * @property Money[] $moneys
 * @property UserAnimal[] $animals
 * @property Map[] $rooms
 * @property UserAnimal[] $horse
 */
class User extends ActiveRecord {

    const ONLINE_TIME = 300;

    const MALE = 1;
    const FAMALE = 0;

    public $hp = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login', 'required'),
			array('email', 'required', 'on' => 'create'),
			array('login', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'),
			array('sex, group_id, stat_id, level, exp, X, Y, last_visit, last_count, page_loaded, energy, energy_max, energy_date', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, group_info', 'length', 'max'=>16),
			array('access', 'length', 'max'=>6),
			array('email, login,avatar', 'length', 'max'=>32),
			array('password', 'length', 'max'=>32),
			array('lang', 'length', 'max'=>3),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
            'buied'     => array(self::HAS_MANY, 'ItemBuied', 'user_id', 'with' => 'item.stat'),
            'itemsUsed'  => array(self::HAS_MANY, 'ItemBuied', 'user_id', 'condition' => 'itemsUsed.used = 1', 'with' => 'item.stat'),
            'group'     => array(self::BELONGS_TO, 'Groups', 'group_id', 'joinType' => 'LEFT JOIN'),
            'army'      => array(self::HAS_MANY, 'Army', 'parent_id'),
            'animals'      => array(self::HAS_MANY, 'UserAnimal', 'user_id'),
            'horse'      => array(self::HAS_ONE, 'UserAnimal', 'user_id','with' => array('animal'), 'on'=>'animal.type="horse"'),
            'weaponsOpened' => array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'weaponsOpened.id ASC', 'index' => 'weaponsOpened.id', 'with' => array('stat','price'), 'on' => 'weaponsOpened.type="Weapon"'),
            'glassesOpened' => array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'glassesOpened.id ASC', 'index' => 'glassesOpened.id','with' => array('stat','price'), 'on' => 'glassesOpened.type="Glass"'),
            'helmetsOpened' => array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'helmetsOpened.id ASC', 'index' => 'helmetsOpened.id', 'with' => array('stat','price'), 'on' => 'helmetsOpened.type="Helmet"'),
            'glovesesOpened'=> array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'glovesesOpened.id ASC', 'index' => 'glovesesOpened.id', 'with' => array('stat','price'), 'on' => 'glovesesOpened.type="Gloves"'),
            'dressesOpened' => array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'dressesOpened.id ASC', 'index' => 'dressesOpened.id', 'with' => array('stat','price'), 'on' => 'dressesOpened.type="Dress"'),
            'botsOpened'    => array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'botsOpened.id ASC', 'index' => 'botsOpened.id', 'with' => array('stat','price'), 'on' => 'botsOpened.type="Bots"'),
            'neclasesOpened'=> array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'neclasesOpened.id ASC', 'index' => 'neclasesOpened.id', 'with' => array('stat','price'), 'on' => 'neclasesOpened.type="Neclase"'),
            'ringsOpened'   => array(self::MANY_MANY, 'Items', 'item_opened(user_id, item_id)', 'order' => 'ringsOpened.id ASC', 'index' => 'ringsOpened.id', 'with' => array('stat','price'), 'on' => 'ringsOpened.type="Ring"'),
            'moneys'   => array(self::HAS_MANY, 'Money', 'user_id', 'with' => 'currency', 'index' => 'currency_id'),
            'friends'  => array(self::HAS_MANY, 'Friends', 'User1', 'with' => 'userTo.group', 'on' => 'friends.Confirm=1 AND friends.Type="friend"'),
            'family'   => array(self::HAS_ONE, 'Friends', 'User1', 'with' => 'userTo.group', 'on' => 'family.Type="family"'),
            'stat'     => array(self::BELONGS_TO, 'Stat', 'stat_id'),
            'income'   => array(self::HAS_MANY, 'UserIncome', 'user_id'),
            'viewPages'   => array(self::HAS_MANY, 'UserViewPage', 'user_id', 'order' => 'viewPages.priority DESC'),
            'canChangeName'   => array(self::HAS_ONE, 'UserCanChangeName', 'user_id', 'order' => 'canChangeName.id DESC', 'on' => 'canChangeName.expires is null or canChangeName.expires > NOW()'),
            'rooms'   => array(self::HAS_MANY, 'Map', 'user_id', 'on' => 'rooms.map_type_id = 5'),
		);
	}

    public function isOnline() {
        return $this->last_visit >= time() - self::ONLINE_TIME;
    }

    public function isAdmin() {
        return $this->access == 'Admin';
    }

    public function isPlayer() {
        return $this->access == 'Player';
    }

    public function isMe() {
        return $this->id == \Yii::$app->user->id;
    }

    public function getCryptedPassword($password) {
        if ($this->isNewRecord) {
            if (!$this->save()) {
                throw new Exception('Ошибка сохранения юзера');
            }
        }
        return md5($password.$this->id.Config::PASSWORD_SALT);
    }

    public function canVisit(Map $map) {
        $range = $this->getRangeOfMovement();
        foreach ($this->rooms as $room) {
            $dx = $map->x - $room->x;
            $dy = $map->y - $room->y;
            if ($dx * $dx + $dy * $dy < $range * $range) {
                return true;
            }
        }
        return false;
    }

    public function getRangeOfMovement() {
        return 10;
    }

    /**
     * @return Battles
     */
    public function getLastBattle() {
        $crit = new CDbCriteria();
        $crit->with = array('userRight','userLeft');
        $crit->compare('userLeft.user_id', $this->id);
        $crit->compare('userRight.user_id', $this->id, false, 'OR');
        $crit->order = 't.changed DESC';
        return Battles::model()->find($crit);
    }

    public function getFriend() {
        $crit = new CDbCriteria();
        $crit->compare('User1', \Yii::$app->user->id);
        $crit->compare('User2', $this->id);
        $crit->compare('Type', 'friend');
        return Friends::model()->find($crit);
    }

    public function updateBonuses() {
        $itemsUsed = $this->itemsUsed;
        $this->stat->setBonusZero();
        foreach ($itemsUsed as $item) {
            $this->stat->joinAsBonus($item->stat);
        }
        return $this->stat->save();
    }


    public function itemsUsed(){
        $items = $this->itemsUsed;
        $res = array('Glass', 'Helmet', 'Weapon', 'Gloves', 'Dress', 'Bots', 'Neclase', 'Ring');
        $res = array_fill_keys($res, false);
        foreach ($items as $item) {
            $res[$item->item->type]  = $item;
        }
        return $res;
    }

    public function getMaxHp() {
        return Config::getHp($this->fullStat(2));
    }


    public function getMoney($currencyId = Config::VALUTA_ID_DEFAULT) {
        $value = 0;
        if (isset($this->moneys[$currencyId])) {
            $value += $this->moneys[$currencyId]->value;
        }
        /** @var UserIncome $income*/
        foreach ($this->income as $income) {
            if ($income->currency_id == $currencyId) {
                $value+= $income->getMoney();
            }
        }
        return $value;
    }

    public function canBuy(ActiveRecord $object, $markUp = 1) {
        if ($markUp < 0) {
            return true;
        }
        foreach ($object->price as $price) {
            /** @var Price $price */
            if (round($price->value * $markUp) > $this->getMoney($price->currency_id)) {
                return false;
            }
        }
        return true;
    }

    public function canBuyFromPrice($prices, $markUp = 1) {
        if ($markUp < 0) {
            return true;
        }
        foreach ($prices as $price) {
            /** @var Price $price */
            if (round($price->value * $markUp) > $this->getMoney($price->currency_id)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $url
     * @param string $count
     * @return ActiveRecord
     */
    public function setViewPage($url, $count = self::COUNT_ONE) {
        return UserViewPage::create(array(
            'user_id' => $this->id,
            'url' => $url,
            'count' => $count
        ));
    }

    public function spendMoneyByPrices($prices, $markUp = 1) {
        if (!$this->canBuyFromPrice($prices, $markUp)) {
            return false;
        }
        foreach ($prices as $price) {
            /** @var Price $price */
            $this->changeMoney(
                 round($price->value * $markUp),
                     false,
                     $price->currency_id
            );
        }
        return true;
    }

    public function spendMoneyByItem(ActiveRecord $object, $markUp = 1) {
        return $this->spendMoneyByPrices($object->price, $markUp);
    }

    public function addMoney($prices, $markUp = 1) {
        foreach ($prices as $price) {
            /** @var $price Price */
            $price->addToUser($this, $markUp);
        }
        return true;
    }

    public function removeMoney($prices, $markUp = 1,$check = true) {
        if ($check && !$this->canBuyFromPrice($prices, $markUp)) {
            return false;
        }
        foreach ($prices as $price) {
            /** @var $price Price */
            $price->removeFromUser($this, $markUp);
        }
        return true;
    }

    public function changeMoney($addToMoney, $check = true, $currencyId = Config::VALUTA_ID_DEFAULT) {
        if (!isset($this->moneys[$currencyId])) {
            if ($check && $addToMoney < 0) {
                return false;
            } else {
                $money = new Money();
                $money->setAttributes(array(
                    'currency_id'    => $currencyId,
                    'user_id' => $this->id,
                    'value'     => $addToMoney
                ));
                $this->moneys[$currencyId] = $money;
                if (!$money->save()) {
                    return false;
                }
                return true;
            }
        }
        $money = $this->moneys[$currencyId];
        if ($check && ($money->value + $addToMoney < 0)) {
            return false;
        } else {
            $money->saveCounters(array('value' => $addToMoney));
            return true;
        }
    }

    public function addExp($expCount) {
        $this->exp+= $expCount;
        while ($this->exp >= Config::getExpToLvl($this->level)) {
            $this->level ++ ;
        }
        $this->save();
    }

    public function isOauthUser($oauthApp) {
        if ($this->login_type != 'oauth') {
            return false;
        }
        if ($this->login_server != $oauthApp) {
            return false;
        }
        return true;
    }

    public function changeAvatar($filePath) {
        try {
            $image = \Yii::$app->image->load($filePath);
            $image->resize(Avatars::AVATAR_WIDTH, null);
            $this->avatar = $this->login . '_'.time().'.png';
            $image->save('.'.Avatars::AVATAR_PATH . $this->avatar);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public static function create($attributes, $scenario = 'create') {
        /** @var User $user  */
        $user = parent::create($attributes);
        $user->setScenario($scenario);
        $stat = new Stat();
        $stat->save();
        $user->stat_id = $stat->id;
        if (!$user->save()) {
            throw new Exception('Ошибка при создании юзера: '. implode(',', array_map('reset', $user->getErrors())));
        }
        foreach (Config::getMoneyOnRegister() as $currencyId => $value) {
            Money::create(array(
                'currency_id' => $currencyId,
                'user_id'     => $user->id,
                'value'       => $value
            ))->save();
        }
        return $user;
    }


}