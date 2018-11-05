<?php

namespace models\base;



/**
 * This is the model class for table "city.user".
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
 * @property string $info
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
 * @property string $url_fixed
 * @property string $url_count
 * @property string $status
 * @property string $changed
 *
 * @property \models\Arena[] $arenas
 * @property \models\BattleAttack[] $battleAttacks
 * @property \models\BattleAttack[] $battleAttacks0
 * @property \models\BattlePrize[] $battlePrizes
 * @property \models\BattleUser[] $battleUsers
 * @property \models\Error[] $errors
 * @property \models\Forum[] $forums
 * @property \models\Friend[] $friends
 * @property \models\Friend[] $friends0
 * @property \models\GroupQuery[] $groupQueries
 * @property \models\GroupQuery[] $groupQueries0
 * @property \models\House[] $houses
 * @property \models\ItemBuied[] $itemBuieds
 * @property \models\ItemOpened[] $itemOpeneds
 * @property \models\MafiaInfo[] $mafiaInfos
 * @property \models\Map[] $maps
 * @property \models\Map[] $maps0
 * @property \models\Message[] $messages
 * @property \models\Message[] $messages0
 * @property \models\Money[] $moneys
 * @property \models\Oauth[] $oauths
 * @property \models\Report[] $reports
 * @property \models\Report[] $reports0
 * @property \models\Topic[] $topics
 * @property \models\Group $group
 * @property \models\Stat $stat
 * @property \models\UserAnimal[] $userAnimals
 * @property \models\UserCanChangeName[] $userCanChangeNames
 * @property \models\UserIncome[] $userIncomes
 * @property \models\UserViewPage[] $userViewPages
 */
class BaseUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseUserPeer::EMAIL, BaseUserPeer::LOGIN, BaseUserPeer::PASSWORD, BaseUserPeer::FIRST_NAME, BaseUserPeer::LAST_NAME, BaseUserPeer::GROUP_INFO, BaseUserPeer::AVATAR, BaseUserPeer::LANG, BaseUserPeer::STAT_ID, BaseUserPeer::X, BaseUserPeer::Y], 'required'],
            [[BaseUserPeer::ACCESS, BaseUserPeer::INFO, BaseUserPeer::SEX, BaseUserPeer::URL_COUNT, BaseUserPeer::STATUS], 'string'],
            [[BaseUserPeer::GROUP_ID, BaseUserPeer::STAT_ID, BaseUserPeer::LEVEL, BaseUserPeer::EXP, BaseUserPeer::X, BaseUserPeer::Y, BaseUserPeer::LAST_COUNT, BaseUserPeer::PAGE_LOADED, BaseUserPeer::ENERGY, BaseUserPeer::ENERGY_MAX], 'integer'],
            [[BaseUserPeer::LAST_VISIT, BaseUserPeer::ENERGY_DATE, BaseUserPeer::CHANGED], 'safe'],
            [[BaseUserPeer::EMAIL, BaseUserPeer::LOGIN, BaseUserPeer::PASSWORD, BaseUserPeer::FIRST_NAME, BaseUserPeer::LAST_NAME, BaseUserPeer::GROUP_INFO, BaseUserPeer::URL_FIXED], 'string', 'max' => 64],
            [[BaseUserPeer::AVATAR], 'string', 'max' => 32],
            [[BaseUserPeer::LANG], 'string', 'max' => 3],
            [[BaseUserPeer::GROUP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseGroup::className(), 'targetAttribute' => [BaseUserPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]],
            [[BaseUserPeer::STAT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStat::className(), 'targetAttribute' => [BaseUserPeer::STAT_ID => BaseStatPeer::STAT_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseUserPeer::USER_ID => 'User ID',
            BaseUserPeer::EMAIL => 'Email',
            BaseUserPeer::LOGIN => 'Login',
            BaseUserPeer::PASSWORD => 'Password',
            BaseUserPeer::FIRST_NAME => 'First Name',
            BaseUserPeer::LAST_NAME => 'Last Name',
            BaseUserPeer::GROUP_INFO => 'Group Info',
            BaseUserPeer::AVATAR => 'Avatar',
            BaseUserPeer::LANG => 'Lang',
            BaseUserPeer::ACCESS => 'Access',
            BaseUserPeer::INFO => 'Info',
            BaseUserPeer::SEX => 'Sex',
            BaseUserPeer::GROUP_ID => 'Group ID',
            BaseUserPeer::STAT_ID => 'Stat ID',
            BaseUserPeer::LEVEL => 'Level',
            BaseUserPeer::EXP => 'Exp',
            BaseUserPeer::X => 'X',
            BaseUserPeer::Y => 'Y',
            BaseUserPeer::LAST_VISIT => 'Last Visit',
            BaseUserPeer::LAST_COUNT => 'Last Count',
            BaseUserPeer::PAGE_LOADED => 'Page Loaded',
            BaseUserPeer::ENERGY => 'Energy',
            BaseUserPeer::ENERGY_MAX => 'Energy Max',
            BaseUserPeer::ENERGY_DATE => 'Energy Date',
            BaseUserPeer::URL_FIXED => 'Url Fixed',
            BaseUserPeer::URL_COUNT => 'Url Count',
            BaseUserPeer::STATUS => 'Status',
            BaseUserPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\ArenaQuery
     */
    public function getArenas() {
        return $this->hasMany(\models\Arena::className(), [BaseArenaPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\BattleAttackQuery
     */
    public function getBattleAttacks() {
        return $this->hasMany(\models\BattleAttack::className(), [BaseBattleAttackPeer::FROM_USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\BattleAttackQuery
     */
    public function getBattleAttacks0() {
        return $this->hasMany(\models\BattleAttack::className(), [BaseBattleAttackPeer::TO_USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\BattlePrizeQuery
     */
    public function getBattlePrizes() {
        return $this->hasMany(\models\BattlePrize::className(), [BaseBattlePrizePeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\BattleUserQuery
     */
    public function getBattleUsers() {
        return $this->hasMany(\models\BattleUser::className(), [BaseBattleUserPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\ErrorQuery
     */
    public function getErrors() {
        return $this->hasMany(\models\Error::className(), [BaseErrorPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\ForumQuery
     */
    public function getForums() {
        return $this->hasMany(\models\Forum::className(), [BaseForumPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\FriendQuery
     */
    public function getFriends() {
        return $this->hasMany(\models\Friend::className(), [BaseFriendPeer::FIRST_USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\FriendQuery
     */
    public function getFriends0() {
        return $this->hasMany(\models\Friend::className(), [BaseFriendPeer::SECOND_USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\GroupQueryQuery
     */
    public function getGroupQueries() {
        return $this->hasMany(\models\GroupQuery::className(), [BaseGroupQueryPeer::AUTHOR_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\GroupQueryQuery
     */
    public function getGroupQueries0() {
        return $this->hasMany(\models\GroupQuery::className(), [BaseGroupQueryPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\HouseQuery
     */
    public function getHouses() {
        return $this->hasMany(\models\House::className(), [BaseHousePeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\ItemBuiedQuery
     */
    public function getItemBuieds() {
        return $this->hasMany(\models\ItemBuied::className(), [BaseItemBuiedPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\ItemOpenedQuery
     */
    public function getItemOpeneds() {
        return $this->hasMany(\models\ItemOpened::className(), [BaseItemOpenedPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\MafiaInfoQuery
     */
    public function getMafiaInfos() {
        return $this->hasMany(\models\MafiaInfo::className(), [BaseMafiaInfoPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMaps() {
        return $this->hasMany(\models\Map::className(), [BaseMapPeer::ROOF_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMaps0() {
        return $this->hasMany(\models\Map::className(), [BaseMapPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\MessageQuery
     */
    public function getMessages() {
        return $this->hasMany(\models\Message::className(), [BaseMessagePeer::USER_FIRST_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\MessageQuery
     */
    public function getMessages0() {
        return $this->hasMany(\models\Message::className(), [BaseMessagePeer::USER_SECOND_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\MoneyQuery
     */
    public function getMoneys() {
        return $this->hasMany(\models\Money::className(), [BaseMoneyPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\OauthQuery
     */
    public function getOauths() {
        return $this->hasMany(\models\Oauth::className(), [BaseOauthPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\ReportQuery
     */
    public function getReports() {
        return $this->hasMany(\models\Report::className(), [BaseReportPeer::USER_FIRST_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\ReportQuery
     */
    public function getReports0() {
        return $this->hasMany(\models\Report::className(), [BaseReportPeer::USER_SECOND_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\TopicQuery
     */
    public function getTopics() {
        return $this->hasMany(\models\Topic::className(), [BaseTopicPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\GroupQuery
     */
    public function getGroup() {
        return $this->hasOne(\models\Group::className(), [BaseGroupPeer::GROUP_ID => BaseUserPeer::GROUP_ID]);
    }
        /**
     * @return \models\StatQuery
     */
    public function getStat() {
        return $this->hasOne(\models\Stat::className(), [BaseStatPeer::STAT_ID => BaseUserPeer::STAT_ID]);
    }
        /**
     * @return \models\UserAnimalQuery
     */
    public function getUserAnimals() {
        return $this->hasMany(\models\UserAnimal::className(), [BaseUserAnimalPeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\UserCanChangeNameQuery
     */
    public function getUserCanChangeNames() {
        return $this->hasMany(\models\UserCanChangeName::className(), [BaseUserCanChangeNamePeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\UserIncomeQuery
     */
    public function getUserIncomes() {
        return $this->hasMany(\models\UserIncome::className(), [BaseUserIncomePeer::USER_ID => BaseUserPeer::USER_ID]);
    }
        /**
     * @return \models\UserViewPageQuery
     */
    public function getUserViewPages() {
        return $this->hasMany(\models\UserViewPage::className(), [BaseUserViewPagePeer::USER_ID => BaseUserPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\UserQuery(get_called_class());
    }
}
