<?php
/**
 * @var CActiveForm $form
 * @var MapType $data
 */
?>
<tr>
<?php $form=$this->beginWidget('CActiveForm', array(
    'action' => Url::to(array('mapType/update', 'id' => $data->id)),
    'enableAjaxValidation' => false
)); ?>
    <td valign="top">
        <?=$form->textField($data,'name'); ?>
    </td>
    <td valign="top">
        <?=$form->textArea($data,'info', array('cols' => 30, 'rows' => 5)); ?>
    </td>
    <td valign="top" align="center">
        <?=$form->checkBox($data,'can_take'); ?>
    </td>
    <td valign="top" align="center">
        <?=$form->checkBox($data,'can_build'); ?>
    </td>
    <td valign="top">
        <?=$form->textField($data,'price', array('size' => 6)); ?>
    </td>
    <td valign="top">
        <?=$form->textField($data,'UserIncome', array('size' => 6)); ?>
    </td>
    <td valign="top">
        <?=CHtml::button('DELETE', array(
            'onclick' => 'if(confirm("Подтвердите удаление")) {
                $(this).parents("tr").remove();
                $.post("/mapType/delete/id/'.$data->id.'");
            }'
        )); ?>
    </td>
    <td valign="top">
        <?=CHtml::activeHiddenField($data, 'id'); ?>
        <?=Html::submitButton('OK'); ?>
    </td>

    <?php $this->endWidget(); ?>

</tr>