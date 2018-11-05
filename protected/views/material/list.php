<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.01.14
 * Time: 13:55
 * @var Currency[] $items
 * @var array $counts
 */
?>
<?php if($items): ?>
    <table class="default" cellpadding="0" cellspacing="0">
        <col width="400px">
        <col width="150px">
        <col width="200px">
        <tr>
            <th>Описание</th>
            <?php foreach ($counts as $count):?>
            <th>Купить #<?php echo $count;?></th>
            <?php endforeach;?>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <img src="images/materials/<?=$item->id;?>.png" style="float:left;margin:5px;"/>
                    <h3><?=$item->title;?></h3>
                    Материал для создания и расширения зданий
                </td>
                <?php foreach ($counts as $count):?>
                <td align="center">
                    <?=Html::moneyButtonByPrices(
                       'Купить '.$count.' за ',
                       'images/info/bay.png',
                       $item->getPrices(),
                       $count * $this->getMarkUp(),
                       array('href' => $this->getUrl('buy', array('id' => $item->id, 'count' => $count)))
                    );?>
                </td>
                <?php endforeach;?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <div style="width:250px;margin:100px 270px">
        Никаких предложений по продаже данной категорий не обнаружено.
    </div>
<?php endif; ?>