<?php
/**
 * @var int $id
 */
?>
<table class="default" cellpadding="0" cellspacing="0" width="600px">
    <tr>
        <th colspan="2">Библиотека</th>
    </tr>
    <tr>
        <td align="center" colspan="2"><img src="images/info/biblioteka.jpg" width="602px" height="399px"/></td>
    </tr>
    <tr>
        <td>
            На данный момент, Ваш интелект составляет <span style="color:red"><?=$user->stat->getStat(1);?></span>
        </td>
        <td style="width:300px">
            <?php foreach (array(1,5,10) as $count):?>
            <?php $price = Yii::$app->config->getStatPrice(1, $count, $user->stat->getStat(1));?>
            <button onclick="location.href='<?=$this->getUrl('add', array('count' => $count));?>'"
                    style="width: 300px" <?php if ($price > $user->getMoney()):?> disabled<?php endif;?>>
                <img src="images/info/library.png">
                Стать умнее на <span style="color:red"><?=$count;?></span>  инт-кта за
                <?=$this->render('//users/_money', array('money' => $price));?>
            </button><br>
            <?php endforeach;?>
        </td>
    </tr>
</table>