<?php
/**
 * @var ActiveDataProvider $dataProvider
 * @var string $userKey fromUser || toUser
 */

use yii\data\ActiveDataProvider;

?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th>#</th>
        <th>Тема</th>
        <th><?php if ($userKey === 'fromUser'):?>От кого<?php else:?>Кому<?php endif;?></th>
        <th>Дата</th>
    </tr>
<?php if($dataProvider->count): ?>
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView'     => '_view',
        'viewData'     => array('userKey' => $userKey),
        'sortableAttributes' => array(
            ucfirst($userKey) => $userKey === 'firstUser' ? 'Автор' : 'Адресат',
            'created' => 'Дата',
            'readed'   => 'Статус'
        ),
        'template' => '
                <tr><td colspan="6">{pager}</td></tr>
                <tr><td colspan="6">{sorter}</td></tr>
                {items}
                <tr><td colspan="6">{pager}</td></tr>
            '
    )); ?>
<?php else: ?>
    <tr>
        <td colspan="4">Список пуст</td>
    </tr>
<?php endif; ?>
</table>
