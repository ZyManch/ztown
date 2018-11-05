<table class="default" cellpadding="0" cellspacing="0">
<tr>
    <th style="width:180px">Тип</th>
    <th>Ставка</th>
</tr>
    <?php for($i=3; $i<=12; $i*=2): ?>
    <tr>
        <td align="center">
            Одна из <?=$i;?> лошадей
        </td>
        <td>
            <form action="<?=$this->getUrl('rate', array('count' => $i));?>" method="post">
                <div>Ставка</div>
                <div class="trackbar" id="tr<?=$i;?>">
                    <div class="value"><?=round(0.1 * $user->getMoney());?>$</div>
                </div>
                <input type="text" name="money" id="th<?=$i;?>" value="">
                <div>Выберите на какую лошадь будите ставить:
                    <div>
                        <?php for($j=0;$j<$i;$j++): ?>
                        <input type="submit" value="На <?=$j+1;?> лошадь">
                        <?php endfor; ?>
                    </div>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>