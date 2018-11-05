<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 17.07.12
 * Time: 14:39
 * To change this template use File | Settings | File Templates.
 * @var Map $map
 */
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">
            Свадьба
        </th>
    </tr>
    <tr>
        <td>
            <img src="images/info/marry.jpg"/>
        </td>
    </tr>
    <tr>
        <td>
            Поздравляем со свадьбой!
        </td>
    </tr>
    <tr>
        <td>
            <?=Html::buttonWithHref(
                'Карта',
                'images/info/map.png',
                array('map/index', 'x'=>$map->x, 'y' => $map->y)
            );?>
        </td>
    </tr>
</table>