<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 05.11.2018
 * Time: 14:38
 * @var \models\MapType $model
 */

use components\Html;

?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">Основное здание</th>
    </tr>
    <tr>
        <td>
            <img src="<?=$model->image();?>" class="tile_info" alt="<?=$model->name;?>">
        </td>
        <td valign="top">
            <h3>
                <?=$model->name;?>
            </h3>


            <?php if ($model->info):?>
                <hr>
                <?=$model->info;?>
            <?php endif;?>

        </td>
    </tr>
</table>

<?php foreach($model->mapTypes0 as $childMapType):?>

<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="3">Можно построить</th>
    </tr>

    <tr>
        <td><img src="<?=$childMapType->image();?>" class="tile_info" alt="<?=$childMapType->name;?>"></td>
        <td colspan="2">
            <h3>
                <?=$childMapType->name;?>
            </h3>


            <?php if ($childMapType->info):?>
                <hr>
                <?=$childMapType->info;?>
            <?php endif;?>
        </td>
    </tr>
    <tr>
        <th>Действие</th>
        <th>Затраты</th>
        <th>Доход</th>
    </tr>

    <tr>
        <td valign="top">
            Постройка
        </td>
        <td valign="top">
            <?=$this->render('//users/_price', ['price' => $childMapType->getPriceForBuild()]);?>
        </td>
        <td valign="top">
            <?=$this->render('//users/_price', ['price' => $childMapType->getPriceIncome(1)]);?>
        </td>
    </tr>

    <?php for ($level=2;$level<=$childMapType->level_max;$level++):?>
    <tr>
        <td valign="top">
            Улучшение #<?=$level;?>
        </td>
        <td valign="top">
            <?=$this->render('//users/_price', ['price' => $childMapType->getPriceForUpdate($level)]);?>
        </td>
        <td valign="top">
            <?=$this->render('//users/_price', ['price' => $childMapType->getPriceIncome($level)]);?>
        </td>
    </tr>
    <?php endfor;?>

</table>

<?php endforeach;?>
