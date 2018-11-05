<?php
/**
 * @var int $centerX
 * @var int $centerY
 * @var int $mapSize
 * @var \components\View $this
 */

$this->registerJs(
'var map = Game(
        $("#map"),
        '.$mapSize.',
        ' . ($centerX) .',
        ' . ($centerY) .'
    );',
    \components\View::POS_READY
);
$this->registerCssFile('/css/map.css');
$this->registerCssFile('/css/tiles.css');
$this->registerJsFile('/js/curves.js');
$this->registerJsFile('/js/easeljs.js');
$this->registerJsFile('/js/preloadjs.js');
$this->registerJsFile('/js/map/map_type.js');
$this->registerJsFile('/js/map/map.js');
$this->registerJsFile('/js/map/sprite.js');
$this->registerJsFile('/js/map/sprite_area.js');
$this->registerJsFile('/js/map/game.js');

?>
<canvas id="map" width="1000px" height="432px"></canvas>