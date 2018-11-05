<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 29.06.12
 * Time: 8:34
 * To change this template use File | Settings | File Templates.
 * @var array $armyNames
 * @var Groups $group
 * @var array $army
 */

use components\Config;

?>
<form action="<?=$this->getUrl('bay');?>" method="post">
    <table class="default" cellpadding="0" cellspacing="0" id="addworks">
        <col/>
        <col width="60px"/>
        <col width="60px"/>
        <col width="80px"/>
        <tr>
            <th>
                <?php switch ($group->Type):
                case 'Works':?>Имя рабочего<?php break;
                case 'Mafia':?>Погоняло вора<?php break;
                case 'Bisiness':?>Имя сотрудника<?php break;
                endswitch;?>
            </th>
            <th>
                <?php switch ($group->Type):
                case 'Mafia':?>Сила<?php break;
                case 'Works':?>Выносливость<?php break;
                case 'Bisiness':?>Логика<?php break;
            endswitch;?>
            </th>
            <th>Цена</th>
            <th>Нанять</th>
        </tr>
        <?php if(!$armyNames): ?>
            <tr>
                <td colspan="4">
                    Список пуст
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($armyNames as $armyName):?>
                <tr>
                    <td><?=$armyName[0]->name;?> <?=$armyName[1]->name;?></td>
                    <td align="center"><?=Config::ARMY_STAT_DEFAULT;?></td>
                    <td align="center"><?=$this->render('//users/_money', array('money' => Config::ARMY_PRICE));?></td>
                    <td align="center">
                        <input type="checkbox" name="army[]" value="<?=$armyName[0]->id.' '.$armyName[1]->id;?>">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table class="default" cellpadding="0" cellspacing="0">
            <col width="33%"/>
            <col width="33%"/>
            <col width="33%"/>
            <tr>
                <th>
                    <?=Items::statLabels(6);?>
                </th>
                <th>
                    Нанято
                </th>
                <th>
                    Вы можете нанять
                </th>
            </tr>
            <tr>
                <td align="center">
                    <span style="color:lime"><?=$user->stat->getSumm(6);?></span>
                </td>
                <td align="center">
                    <span style="color:red"><?=sizeof($army);?></span>
                </td>
                <td align="center">
                    <span style="color:gray"><?=$user->stat->getSumm(6)-sizeof($army);?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="#" onclick="$('#addworks input').attr('checked',true);return false;">Выбрать всех</a> /
                    <a href="#" onclick="$('#addworks input').attr('checked',false);return false;">отменить всех</a>
                </td>
                <td>
                    <input type="submit" name="add" value="Нанять" style="width: 100%">
                </td>
            </tr>
            <?php endif; ?>
    </table>
</form>