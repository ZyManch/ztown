<?php
/**
 * @var int $price
 * @var Groups $model
 * @var CActiveForm $form
 * @var Map $map
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => false
)); ?>
    <table class="default" cellpadding="0" cellspacing="0">
        <col width="445px"/>
        <col width="205px"/>
        <tr>
            <th>Название группировки</th>
            <th>#</th>
        </tr>
        <tr>
            <td>
                <?=$form->textField($model, 'name', array('size' => 60));?>
            </td>
            <td>
                Создать группировку за
                <?=Html::moneyButton(
                    '',
                    'images/info/bay.png',
                    $map->mapType,
                    1,
                    array('type' => 'submit')
                );?>
            </td>
        </tr>
    </table>
<?php $this->endWidget(); ?>