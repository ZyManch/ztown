<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.03.2018
 * Time: 15:57
 * @var View $this
 */

use components\Html;
use components\View;

?>
<div class="menu">
    <div class="spacer">
        <ul>
            <li><?=Html::a('Главная', ['site/index']);?></li>
            <?php if(Yii::$app->user->isGuest):?>
                <li><?=Html::a('Вход', ['site/login']);?></li>
                <li><?=Html::a('Регистрация', ['register/index']);?></li>
            <?php else:?>
                <li><?=Html::a('Профиль', ['users/profile']);?></li>
                <li><?=Html::a('Карта', ['maps/index']);?></li>
                <?php if ($this->context->user->isAdmin()):?>
                    <li><?=Html::a('Редактор карт', ['maps/admin']);?></li>
                    <li><?=Html::a('Здания', ['mapTypes/admin']);?></li>
                    <li><?=Html::a('Корректировка CSS', ['generator/css']);?></li>
                <?php endif;?>
                <li><?=Html::a('Выход', ['site/logout']);?></li>
            <?php endif;?>
        </ul>
    </div>
</div>
