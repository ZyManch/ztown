<?php

/**
 * This is the model class for table "stats".
 *
 * The followings are the available columns in table 'stats':
 * @property integer $id
 * @property integer $stat1
 * @property integer $stat2
 * @property integer $stat3
 * @property integer $stat4
 * @property integer $stat5
 * @property integer $stat6
 * @property integer $bonus1
 * @property integer $bonus2
 * @property integer $bonus3
 * @property integer $bonus4
 * @property integer $bonus5
 * @property integer $bonus6
 * @property string $status
 * @property string $changed
 */
class Stat extends ActiveRecord {


    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'stat';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {
        return array(
            array('changed', 'safe'),
            array('stat1, stat2, stat3, stat4, stat5, stat6, bonus1, bonus2, bonus3, bonus4, bonus5, bonus6', 'numerical', 'integerOnly'=> true),
            array('status', 'length', 'max'=> 7)
        );
    }

    public function getSumm($index) {
        return $this->getStat($index) + $this->getBonus($index);
    }

    public function getStat($index) {
        return $this->getAttribute('stat'.$index);
    }

    public function getBonus($index) {
        return $this->getAttribute('bonus'.$index);
    }

    public function setBonusZero() {
        for ($i=1; $i<=6; $i++) {
            $this->setAttribute('bonus'.$i, 0);
        }
    }

    public function joinStat(Stat $stat) {
        for ($i=1; $i<=6; $i++) {
            $this->addToStat($i, $stat->getStat($i));
            $this->addToBonus($i, $stat->getBonus($i));
        }
    }

    public function joinAsBonus(Stat $stat) {
        for ($i=1; $i<=6; $i++) {
            $this->addToBonus($i, $stat->getSumm($i));
        }
    }

    public function addToBonus($index, $value) {
        $this->setAttribute('bonus' . $index, $this->getBonus($index) + $value);
    }

    public function addToStat($index, $value) {
        $this->setAttribute('stat' . $index, $this->getStat($index) + $value);
    }

}