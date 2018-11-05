<?php

/**
 * This is the model class for table "battles_user".
 *
 * The followings are the available columns in table 'battles_user':
 * @property integer $id
 * @property integer $user_id
 * @property integer $battle_id
 * @property string $side
 * @property User $user
 * @property Stat $stat
 */
class BattleUser extends ActiveRecord {


    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'battles_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, battle_id, stat_id', 'required'),
            array('user_id, battle_id, stat_id', 'numerical', 'integerOnly'=> true),
            array('side', 'length', 'max' => 7),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'stat' => array(self::BELONGS_TO, 'Stat', 'stat_id')
        );
    }

    public static function getFromUser(User $user, $battleId) {
        $battleUser = new self();
        $stat = new Stat();
        for($i=1; $i<=6; $i++) {
            $stat->setAttribute('stat'.$i, $user->stat->getAttribute('stat' .$i));
            $stat->setAttribute('bonus'.$i, $user->stat->getAttribute('bonus' .$i));
        }
        $stat->save();
        $battleUser->setAttributes(array(
            'user_id'=>$user->id,
            'battle_id'=>$battleId,
            'stat_id' => $stat->id
        ));
        return $battleUser;
    }

}