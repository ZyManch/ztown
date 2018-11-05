<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property string $name
 * @property string $lower_name
 * @property string $Type
 * @property integer $Mens
 * @property integer $CanTake
 * @property integer $Taked
 * @property integer $Balls
 * @property MafiaInfo $mafiaInfo
 * @property array $members
 */
class Groups extends ActiveRecord {

    const MAFIA = 'Mafia';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('Mens, CanTake, Taked, Balls', 'numerical', 'integerOnly'=>true),
			array('name, lower_name', 'length', 'max'=>32),
			array('Type', 'length', 'max'=>8),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
            'members'   => array(self::HAS_MANY, 'User', 'group_id', 'with' => array('stat','army')),
            'mafiaInfo' => array(self::HAS_ONE, 'MafiaInfo', 'group_id'),
		);
	}

    const MAFIA = 'Mafia';

    public function beforeSave() {
        $this->lower_name = strtolower($this->name);
        return true;
    }

    public function groupLabel() {
        switch ($this->Type) {
            case 'Works':    return 'Фабрика';     break;
            case 'Mafia':    return 'Группировка'; break;
            case 'Bisiness': return 'Корпорация';  break;
        }
    }

    public function inviteLabel() {
        switch ($this->Type) {
            case 'Mafia':    return 'Вербовать';           break;
            case 'Works':    return 'Нанять';              break;
            case 'Bisiness': return 'Пригласить работать'; break;
        }
    }

    public function info() {
        switch ($this->Type) {
            case 'Mafia': return $this->mafiaInfo; break;
        }
    }

    public function isHead() {
        return $this->info()->user_id == \Yii::$app->user->getId();
    }

    public function getInviteInfo($userId) {
        $crit = new CDbCriteria();
        $crit->compare('group_id', $this->id);
        $crit->compare('user_id', $userId);
        return GroupQuery::model()->find($crit);
    }

}