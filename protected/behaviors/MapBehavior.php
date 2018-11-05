<?php
namespace behaviors;
use yii\base\Behavior;

/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 20:13
 */
class MapBehavior extends Behavior {

    /**
     * @param CModelEvent $on
     * @return bool
     */
    public function beforeSave($on) {
        /** @var Map $model  */
        $model = $this->getOwner();
        if (!$model->street_id) {
            $street = Street::model()->
                find(array(
                    'params' => array(':x' => $model->x,':y' => $model->y),
                    'condition' => ':x between left_x and right_x and :y between top_y and bottom_y',
                    'order' => '(right_x - left_x)*(bottom_y - top_y) ASC'
                ));
            if (!$street) {
                $street = Street::model()->
                    find(array(
                        'params' => array(':x' => $model->x,':y' => $model->y),
                        'order' => 'ABS(2 * :x - left_x - right_x) + ABS(2 * :y - top_y - bottom_y) ASC,
                            (right_x - left_x)*(bottom_y - top_y) ASC'
                    ));
            }
            $previousMap = Map::model()->
                find(array(
                    'condition' => 'street_id = :street',
                    'params' => array(':street' => $street->id),
                    'order' => 'house DESC'
                ));
            $model->street_id = $street->id;
            $model->house = $previousMap ? $previousMap->house + 1 : 1;
        }
        return true;
    }

}