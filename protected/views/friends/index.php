<?php
/**
 * @var ActiveDataProvider $dataProvider
 */

use yii\data\ActiveDataProvider;

?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th>#</th>
        <th colspan="2">Пользователь</th>
    </tr>
    <?php if($dataProvider->count > 0): ?>
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView'     => '_view',
           'template' => '
                <tr><td colspan="6">{pager}</td></tr>
                {items}
                <tr><td colspan="6">{pager}</td></tr>
            '
        )); ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Список пуст</td>
        </tr>
    <?php endif; ?>
</table>
