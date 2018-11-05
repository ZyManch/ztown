<?php

namespace models;

use Yii;

/**
 * This is the model class for table "stat".
 *
 * @property string $stat_id
 * @property string $stat1
 * @property string $stat2
 * @property string $stat3
 * @property string $stat4
 * @property string $stat5
 * @property string $stat6
 * @property string $bonus1
 * @property string $bonus2
 * @property string $bonus3
 * @property string $bonus4
 * @property string $bonus5
 * @property string $bonus6
 * @property string $status
 * @property string $changed
 *
 * @property Animal[] $animals
 * @property BattleUser[] $battleUsers
 * @property Item[] $items
 * @property ItemBuied[] $itemBuieds
 * @property User[] $users
 * @property UserAnimal[] $userAnimals
 */
class Stat extends base\BaseStat {


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