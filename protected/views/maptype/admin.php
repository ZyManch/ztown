<?php
/**
 * @var CActiveDataProvider $dataProvider
 */
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th>Тайл</th>
        <th>Тип</th>
        <th>Описание</th>
        <th>Включен</th>
        <th>Захват</th>
        <th>Постройка</th>
        <th>Стоимость</th>
        <th>Доход</th>
        <th>Удалить</th>
        <th>#</th>
    </tr>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView'     => '_form',
    )); ?>

</table>