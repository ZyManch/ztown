<?php
/**
 * @var array $incomes
 * @var UserIncome $income
 */
?>
<script language="JavaScript">
    var t = [];
    <?php foreach($incomes as $income):?>
        t.push(<?=$income->getSecondsToIncome();?>);
    <?php endforeach;?>
    setInterval(function() {
        for(i=0; i < t.length; i++) {
            if(t[i]<0) t[i]+= 3600*24;
            var a = t[i]%60;
            var b = Math.floor(t[i]/60);
            var c = Math.floor(b/60);
            b = b%60;
            a = (a==0?'00':(a<10?'0'+a:a));
            b = (b==0?'00':(b<10?'0'+b:b));
            c = (c==0?'00':(c<10?'0'+c:c));
            document.getElementById('timer'+i).innerHTML = c+':'+b+':'+a;
            if(t[i]<=0) window.location.reload();
            t[i]--;
        }
    }, <?=(int)(1000/\components\Date::GAME_SPEED);?>);
</script>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th>#</th>
        <th>Время</th>
        <th>Время до события</th>
        <th>Доход</th>
    </tr>
    <?php if (!sizeof($incomes)): ?>
    <tr>
        <td colspan="4">
            Список пуст
        </td>
    </tr>
    <?php endif; ?>
    <?php foreach ($incomes as $pos => $income): ?>
    <tr>
        <td>
            <?=$income->id;?>
        </td>
        <td>
            <?=gmdate('H:i:s', $income->Time);?>
        </td>
        <td>
            <span id="timer<?=$pos;?>">
                <?=gmdate('H:i:s', $income->getSecondsToIncome());?>
		    </span>
        </td>
        <td>
            <?=$this->render('//users/_money', array('money' => $income->Income));?>
        </td>
    </tr>
    <?php endforeach;?>
</table>