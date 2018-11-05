<?php

namespace models;

use components\Config;
use components\price\Contract;
use components\user\Storage;
use Yii;
use yii\db\ActiveRecord;
use yii\image\ImageDriver;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $user_id
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $group_info
 * @property string $avatar
 * @property string $lang
 * @property string $access
 * @property string $sex
 * @property string $group_id
 * @property string $stat_id
 * @property string $level
 * @property string $exp
 * @property string $x
 * @property string $y
 * @property string $last_visit
 * @property string $last_count
 * @property string $page_loaded
 * @property string $energy
 * @property string $energy_max
 * @property string $energy_date
 * @property string $status
 * @property string $changed
 *
 * @property Arena[] $arenas
 * @property BattleAttack[] $battleAttacks
 * @property BattleAttack[] $battleAttacks0
 * @property BattlePrize[] $battlePrizes
 * @property BattleUser[] $battleUsers
 * @property Error[] $errors0
 * @property Forum[] $forums
 * @property Friend[] $friends
 * @property Friend[] $friends0
 * @property GroupRequest[] $groupQueries
 * @property GroupRequest[] $groupQueries0
 * @property House[] $houses
 * @property ItemBuied[] $itemBuieds
 * @property ItemOpened[] $itemOpeneds
 * @property MafiaInfo[] $mafiaInfos
 * @property Map[] $maps
 * @property Map[] $maps0
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property Money[] $moneys
 * @property Oauth[] $oauths
 * @property Report[] $reports
 * @property Report[] $reports0
 * @property Topic[] $topics
 * @property Group $group
 * @property Stat $stat
 * @property UserAnimal[] $userAnimals
 * @property UserCanChangeName[] $userCanChangeNames
 * @property UserIncome[] $userIncomes
 * @property UserViewPage[] $userViewPages
 * @property ItemOpened[] $itemUsed
 * @property Map[] $rooms
 */
class User extends base\BaseUser implements IdentityInterface {

    const ONLINE_TIME = 300;

    const ACCESS_PLAYER = 'player';
    const ACCESS_ADMIN = 'admin';

    const MALE = 1;
    const FAMALE = 0;

    public $hp = 0;

    protected $_storage;

    /**
     * @return Storage
     */
    public function getStorage() {
        if (!$this->_storage) {
            $this->_storage = new Storage($this);
        }
        return $this->_storage;
    }


    public function isOnline() {
        return strtotime($this->last_visit) >= time() - self::ONLINE_TIME;
    }

    public function isAdmin() {
        return $this->access === self::ACCESS_ADMIN;
    }

    public function isPlayer() {
        return $this->access === self::ACCESS_PLAYER;
    }

    public function isMe() {
        return $this->id == \Yii::$app->user->id;
    }

    public function getCryptedPassword($password) {
        if ($this->isNewRecord) {
            if (!$this->save()) {
                throw new \Exception('Ошибка сохранения юзера');
            }
        }
        return sha1($password.$this->user_id.\Yii::$app->params['salt_for_user']);
    }

    public function canVisit(Map $map) {
        if($map->map_type_id == 5) {
            return true;
        }
        $range = $this->getRangeOfMovement();
        foreach ($this->houses as $house) {
            $dx = $map->x - $house->map->x;
            if (abs($dx) > $range) {
                continue;
            }

            $dy = $map->y - $house->map->y;
            if ((-$dy-$dx <= $range) && ($dy+$dx <= $range)) {
                return true;
            }
        }
        return false;
    }

    public function getRooms() {
        return $this->
            hasMany(\models\Map::className(), ['user_id' => 'user_id'])->
            where('[[map_type_id]]=5');
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemUsed()
    {
        return $this->
            hasMany(\models\ItemBuied::class, ['user_id' => 'user_id'])->
            where(['used'=>ItemBuied::USED_YES])->
            with('item');
    }

    public function itemsUsed(){
        $items = $this->itemUsed;
        $res = array_fill_keys(Item::EQUIPPED_TYPES, null);
        foreach ($items as $item) {
            $res[$item->item->type]  = $item;
        }
        return $res;
    }

    public function getMaxHp() {
        return Config::getHp($this->fullStat(2));
    }

    /**
     * @param $url
     * @param string $count
     * @return ActiveRecord
     */
    public function setViewPage($url, $count = UserViewPage::COUNT_ONE) {
        $view = new UserViewPage();
        $view->user_id = $this->user_id;
        $view->url = $url;
        $view->count = $count;
        $view->save();
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
            /** @var ImageDriver $gd */
            $gd = \Yii::$app->image;
            $image = $gd->load($filePath);
            $image->resize(Avatar::AVATAR_WIDTH, null);
            $this->avatar = $this->user_id . '_'.time().'.png';
            $image->save(Yii::getAlias('@web').Avatar::AVATAR_PATH . $this->avatar);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public static function create($attributes) {
        $user = new self();
        $user->setAttributes($attributes);

        $stat = new Stat();
        $stat->save();
        $user->stat_id = $stat->stat_id;
        if (!$user->save()) {
            throw new \Exception('Ошибка при создании юзера: '. implode(',', array_map('reset', $user->getErrors())));
        }
        foreach (Config::getMoneyOnRegister() as $currencyId => $value) {
            $money = new Money();
            $money->currency_id = $currencyId;
            $money->user_id     = $user->user_id;
            $money->value       = $value;
            $money->save();
        }
        return $user;
    }


    public static function findIdentity($id) {
        return self::find()->where('user_id = :id', [':id' => $id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \Exception('Site not support auto authentication system');
    }

    public function getId() {
        return $this->user_id;
    }

    public function getAuthKey() {
        return md5($this->password.$this->user_id.\Yii::$app->params['salt_for_user']);
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        return $this->password === $this->getCryptedPassword($password);
    }
}