<?php
/**
 * @var MapType $data
 */
?>
<tr>
    <td valign="top">
        <?=Html::img('images/town/mapType/tile'.$data->id.'.png', '', array(
        'width' => 35,
    ));?>
    </td>
    <td valign="top">
        <?=$data->name; ?>
    </td>
    <td valign="top">
        <?=$data->info; ?>
    </td>
    <td valign="top" align="center">
        <?=$data->can_take ? 'V' : 'X'; ?>
    </td>
    <td valign="top" align="center">
        <?=$data->can_build ? 'V' : 'X'; ?>
    </td>
    <td valign="top" align="center">
        <?=$data->can_update ? 'V' : 'X'; ?>
    </td>
    <td valign="top" align="center">
        <?=$data->can_markup ? 'V' : 'X'; ?>
    </td>
    <td valign="top">
        <?=$this->render('//users/_money', array('money' => $data->price)); ?>
    </td>
    <td valign="top">
        <?=$this->render('//users/_money', array('money' => $data->Income)); ?>
    </td>
</tr>