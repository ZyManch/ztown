<?php
/**
 * @var int $id
 */
?>
<table class="default" cellpadding="0" cellspacing="0" width="600px">
    <tr>
        <th colspan="2">Тренажор</th>
    </tr>
    <tr>
        <td align="center" colspan="2"><img src="images/info/trenajor.jpg" width="602px" height="338px"/></td>
    </tr>
    <tr>
        <td>
            На данный момент, Ваша выносливость равна <span style="color:red"><?=$user->stat->getStat(2);?></span>
        </td>
        <td style="width:300px">
            <?php foreach (array(1,5,10) as $count):?>
                <?php $price = Yii::$app->config->getStatPrice(2, $count, $user->stat->getStat(2));?>
                <button onclick="location.href='<?=$this->getUrl('add', array('count' => $count));?>'"
                    style="width: 300px" <?php if ($price > $user->getMoney()):?> disabled<?php endif;?>>
                    <img src="images/info/train.png">
                    Стать сильнее на <span style="color:red"><?=$count;?></span>
                    силы за <?=$this->render('//users/_money', array('money' => $price));?>
                </button><br>
            <?php endforeach;?>
        </td>
    </tr>
</table>
