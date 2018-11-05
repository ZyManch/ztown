<?php

namespace models;

/**
 * This is the ActiveQuery class for [[Avatar]].
 *
 * @see Avatar
 */
class AvatarQuery extends base\BaseAvatarQuery {

    public function init() {
        parent::init();
        $this->addOrderBy('[[position]]');
    }


}