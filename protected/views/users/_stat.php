<?php
/**
 * @var User $user
 * @var int $statId
 */
?>
<?=Items::statLabels($statId);?>:

<?=$user->stat->getStat($statId);?>
<?php if ($user->stat->getBonus($statId) > 0):?>
    <span class="lime_text">+<?=$user->stat->getBonus($statId);?></span>
<?php elseif($user->stat->getBonus($statId) < 0):?>
    <span class="red_text">-<?=$user->stat->getBonus($statId);?></span>
<?endif;?>