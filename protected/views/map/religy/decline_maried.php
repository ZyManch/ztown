<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 17.07.12
 * Time: 14:07
 * @var User $user
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
            <?php if($user->sex == User::FAMALE): ?>
            Вы отказались выходить замуж
            <?php else: ?>
            Вы отказались жениться
            <?php endif; ?>
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