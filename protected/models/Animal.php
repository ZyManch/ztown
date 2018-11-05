<?php

namespace models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property string $animal_id
 * @property int $level
 * @property string $stat_id
 * @property string $name
 * @property string $type
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property Stat $stat
 * @property UserAnimal[] $userAnimals
 */
class Animal extends base\BaseAnimal {

    public function image() {
        return 'images/animals/'.$this->type.$this->animal_id.'.png';
    }

}
