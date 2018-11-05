<?php

namespace models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "income".
 *
 * @property string $income_id
 * @property string $source_type
 * @property string $source_id
 * @property string $map_type_id
 * @property string $currency_id
 * @property string $income_type
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property Currency $currency
 * @property MapType $mapType
 */
class Income extends base\BaseIncome {


    public function assignToUser($userId, ActiveRecord $source) {
        $income = new UserIncome();
        $income->setAttributes(array(
           'user_id'       => $userId,
           'currency_id'   => $this->currency_id,
           'income_type'   => $this->income_type,
           'source_type'   => get_class($source),
           'source_id'     => $source->primaryKey,
           'value'         => $this->value
        ));
        $income->save();
    }


}