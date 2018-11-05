<?php
namespace behaviors;
use yii\base\Behavior;

/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 20:13
 */
class BattlePrizeBehavior extends Behavior {

    /**
     * @param CModelEvent $on
     * @return bool
     */
    public function beforeSave($on) {
        /** @var BattlePrize $model  */
        $model = $this->getOwner();
        if (!$model->getIsNewRecord()) {
            return true;
        }
        $model->appendPrize();
        return true;
    }

}