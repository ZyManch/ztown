<?php
/**
 * @var Map $map
 * @var Work[] $works
 */

use components\Html;

?>
<table class="default" cellpadding="0" cellspacing="0">
    <col width="100px">
    <col>
    <col width="100px">
    <tr>
        <th>#</th>
        <th>Описание</th>
        <th>#</th>
    </tr>
    <?php foreach ($works as $work):?>
    <tr>
        <td><?php echo Html::img('/images/work/'.$work->image);?></td>
        <td style="vertical-align: top">
            <b><?php echo $work->title;?></b>
            <br>
            <?php echo $work->description;?>
            <br>
            Бонус: +<?php echo $work->workBonus->count();?>
        </td>
        <td>
            <?=Html::moneyButton(
                   '',
                   'images/info/bay.png',
                   $work,
                   1,
                   array('href' => $this->getUrl('addWork',array('id' => $work->id)))
            );?>
        </td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="3" align="right">
            <?=Html::buttonWithImage(
                   'Отмена',
                   'images/info/bay.png',
                   array('href' => $this->getUrl('view'))
            );?>
        </td>
    </tr>
</table>