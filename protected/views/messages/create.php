<?php
/**
 * @var Messages $model
 * @var CActiveForm $form
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'moneys-form',
    'enableAjaxValidation'=>false,
)); ?>
<table cellpadding="0" cellspacing="0" class="default">
    <col width="100px"/>
    <col/>
    <tr>
        <th colspan="2">Отправка сообщения</th>
    </tr>
    <tr>
        <td valign="top" rowspan="2"><?=$this->render('//users/_avatar', array('user' => $model->user_second_id));?></td>
        <td valign="top">
            Тема письма
            <?php echo $form->textField($model,'title', array('size' => 45)); ?>
            <?php echo $form->error($model,'title'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->textArea($model,'content', array('style' => 'width: 100%', 'rows' => 10)); ?>
            <?php echo $form->error($model,'content'); ?>
        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>