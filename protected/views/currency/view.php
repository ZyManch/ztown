<?php
/**
 * @var array $currencies
 * @var Currency $currency
 * @var EventController $this
 */
?>
<script language="JavaScript">
    <?php foreach($currencies as $currency): ?>
        var tr<?=$currency->id;?>;
    <?php endforeach; ?>

    function update(){
        var d = false;
        <?php foreach ($currencies as $currency): ?>
        if(!tr<?=$currency->id;?>.timechange()) {
            d = true;
        }
        <?php endforeach; ?>
        if(d) $.getScript("<?=$this->getUrl('ajax');?>");
    }

    $(document).ready(function(){
        <?php foreach ($currencies as $currency): ?>
        tr<?=$currency->id;?> = new trackbar('tr<?=$currency->id;?>','obmen1_<?=$currency->id;?>','obmen2_<?=$currency->id;?>',[<?=$currency->userMoney->value;?>,<?=$currency->course;?>,"<?=$currency->ext;?>"],[<?=$user->getMoney();?>,1,"$"]);
        tr<?=$currency->id;?>.setdelay(<?=max($currency->lastChange(), 2);?>);
        tr<?=$currency->id;?>.updatevalue();
        <?php endforeach; ?>
        setInterval('update()',1000/<?=\components\Date::GAME_SPEED;?>);
    });
</script>

<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">Курсы валют</th>
    </tr>
    <?php foreach ($currencies as $currency): ?>
    <tr>
        <td rowspan="2">
            <?=$currency->title;?>
        </td>
        <td>
            <img src="images/download/currency<?=$currency->id;?>.png?<?=time();?>" id="val<?=$currency->id;?>">
        </td>
    </tr>
    <tr>
        <td>
            <form action="<?=$this->getUrl('buy');?>" method="post">
                <input type="hidden" name="id" value="<?=$currency->id;?>">
                <div>
                    Время до смены курса: <span class="timecurse" id="tr<?=$currency->id;?>_time"><?=$currency->lastChange();?></span> секунд
                </div>
                <div>
                    Текущий курс: <?=$this->render('//users/_money', array('money' => $currency->course, 'id' => 'currency' .$currency->id, 'round' => 2));?>
                </div>
                <div>
                    Наличные:
                    <?=$this->render('//users/_money', array('money' => $currency->userMoney->value, 'currency' => $currency));?>
                    [<?=$this->render('//users/_money', array('money' => $user->getMoney()));?>]
                </div>
                <div>
                    Обмен:
					<span class="money">
						<input type="text" name="value" id="obmen1_<?=$currency->id;?>" value="<?=$currency->userMoney->value;?>"> <?=$currency->ext;?>
					</span>
                    [<span class="money">
						<input type="text" id="obmen2_<?=$currency->id;?>" value="<?=Currency::getDefaultValute()->userMoney->value;?>" disabled> <?=Currency::getDefaultValute()->ext;?>
					</span>]
                    <input type="submit" id="tr<?=$currency->id;?>_button" value="Менять">
                </div>

                <div>
                    <div class="trackbar" id="tr<?=$currency->id;?>">
                        <div class="value"><?=$currency->userMoney->value.$currency->ext;?></div>
                        <div class="de_value"><?=Currency::getDefaultValute()->userMoney->value.Currency::getDefaultValute()->ext;?></div>
                    </div>
                </div>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>