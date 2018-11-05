<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 14.04.13
 * Time: 11:27
 */

use components\Html;

?>
<div class="oauth">
    <?=Html::a('', array('site/oauth', 'id' => 'vk'), array('class'=>'vk'));?>
    <?=Html::a('', array('site/oauth', 'id' => 'twitter'), array('class'=>'twitter'));?>
    <?=Html::a('', array('site/oauth', 'id' => 'facebook'), array('class'=>'facebook'));?>
</div>