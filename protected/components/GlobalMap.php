<?php
namespace components;
use models\Map;

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 05.11.2018
 * Time: 13:46
 */
class GlobalMap {

    const MAP_VIEW_SIZE = 25;

    public function getMap($leftX, $topY) {
        $mapItems = Map::find()->
            where(
                'x BETWEEN :x AND :x + :size - 1 AND y BETWEEN :y AND :y + :size - 1',
                [
                    'x'    => $leftX,
                    'y'    => $topY,
                    'size' => self::MAP_VIEW_SIZE
                ]
            )->with([
                    'street',
                    'mapType',
                    'user'
                ])->all();
        $map = $this->getEmptyMap($leftX, $topY);
        foreach ($mapItems as $mapItem) {
            $x = $mapItem->x;
            $y = $mapItem->y;
            $map[$x][$y] = $this->toArray($mapItem);
        }
        return $map;
    }

    protected function getEmptyMap($leftX, $topY) {

        $result = array();
        for ($x = $leftX; $x < $leftX + self::MAP_VIEW_SIZE; $x++) {
            for ($y = $topY; $y < $topY + self::MAP_VIEW_SIZE; $y++) {
                $grass = new Map();
                $grass->land_type_id = 0;
                $grass->x = $x;
                $grass->y = $y;
                $result[$x][$y] = $this->toArray($grass);
            }

        }
        return $result;
    }

    public function toArray(Map $map) {
        return array(
            'land_type_id' => $map->land_type_id,
            'map_type_id' => $map->map_type_id,
            'user_id'    => $map->user_id,
            'first_name' => $map->user_id ? $map->user->first_name : '',
            'controller'      => $map->mapType->controller,
            'name'      => $map->mapType->name,
            'enabled' => \Yii::$app->user->getIdentity()->canVisit($map)
        );
    }
}