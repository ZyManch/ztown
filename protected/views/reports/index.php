<?php
/**
 * @var ActiveDataProvider $dataProvider
 * @var ListView $widget
 */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th>#</th>
        <th>Дата</th>
        <th>От кого</th>
        <th>Кому</th>
        <th>Описание</th>
        <th>Деньги</th>
    </tr>
    <?php if($dataProvider->count === 0): ?>
        <tr>
            <td colspan="6">
                Список пуст
            </td>
        </tr>
        <?php else:?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView'     => '_view',
                'sortableAttributes' => array(
                    'title'    => 'Тип операции',
                    'user_first_id' => 'Отправитель',
                    'user_second_id'   => 'Адресат',
                    'Date'     => 'Дата',
                    'Money'    => 'Денег'
                ),
                'template' => '
                    <tr><td colspan="6">{sorter}</td></tr>
                    <tr><td colspan="6">{pager}</td></tr>
                    {items}
                    <tr><td colspan="6">{pager}</td></tr>
                '
             ]);?>
        <?php endif; ?>
</table>