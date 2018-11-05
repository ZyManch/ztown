<?php
/**
 * @var Stat $stat
 */
?>
<?php for($j=1;$j<=6;$j++):?>
    <?php
    $statistic = $stat->getAttribute('stat'.$j);
    $bonus =  $stat->getAttribute('bonus'.$j);
    ?>
    <?php if($statistic || $bonus):?>
    <div>
            <?=Items::statLabels($j);?>:
            <?=$statistic;?>
            <?php if($bonus>0):?>
            <span class="lime_text">+<?=$bonus;?></span>
            <?php elseif($bonus<0):?>
            <span class="red_text">-<?=$bonus;?></span>
            <?php endif;?>
    </div>
    <?php endif;?>
<?php endfor;?>