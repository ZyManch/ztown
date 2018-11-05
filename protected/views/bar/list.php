<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 29.06.12
 * Time: 8:44
 * To change this template use File | Settings | File Templates.
 * @var Groups $group
 * @var array $army
 * @var Army $solder
 */
?>
<table class="default" cellpadding="0" cellspacing="0" id="addworks">
    <?php if($group): ?>
        <tr>
            <th><?php switch($group->Type):
                    case 'Works':?>Имя рабочего<?php break;
                    case 'Mafia':?>Погоняло вора<?php break;
                    case 'Bisiness':?>Имя сотрудника<?php break;
                endswitch;?>
            </th>
            <th style="width:60px">&nbsp;
                <?php switch ($group->Type):
                    case 'Mafia':?>Сила<?php break;
                    case 'Works':?>Выносливость<?php break;
                    case 'Bisiness':?>Логика<?php break;
                endswitch;?>
            </th>
            <th style="width:40px">&nbsp;</th>
        </tr>
        <?php foreach ($army as $solder):?>
            <tr>
                <td>
                    <?=$solder->name;?>
                </td>
                <td align="center">
                    <?=$solder->stat;?>
                </td>
                <td align="center">
                    <a href="<?=$this->getUrl('delete', array('id' => $solder->id));?>">
                        <img src="images/info/delete.png">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$army):?>
            <tr>
                <td colspan="3">
                    Список пуст
                </td>
            </tr>
        <?php endif; ?>
    <?php else: ?>
    <tr>
        <td>
            Вступите в группу
        </td>
    </tr>
    <?php endif; ?>
</table>