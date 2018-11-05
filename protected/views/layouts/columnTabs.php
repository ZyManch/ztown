<?php
/**
 * @var $pages
 * @var View $this
 */

use components\Html;
use components\View;
/** @var \controllers\base\EventController $controller */
$controller = Yii::$app->controller;
$map = $controller->map;
$pages = $controller->getPages();
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<table cellpadding="0" cellspacing="0" class="pages">
    <tr>
        <td class="space">&nbsp;</td>
        <td class="page<?=('view' === $controller->action->id?' active':'');?>">
            <?=Html::a('Здание', $controller->map->getUrl('view'));?>
        </td>
        <?php foreach ($pages as $name => $action):?>
            <td class="page<?=($action == $controller->action->id?' active':'');?>">
            <?=Html::a(
                $name,
                strpos($action,'/')!==false ? $action : $controller->map->getUrl($action)
            );?>
            </td>
        <?php endforeach;?>
            <td class="page">
                <?=Html::a('Карта', ['maps/index','x'=>$map->x,'y'=>$map->y]);?>
            </td>
        <td class="endspace">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="<?=(count($pages)+4);?>" class="pagecontent">
            <?php echo $content; ?>
        </td>
    </tr>
</table>
<?php $this->endContent(); ?>