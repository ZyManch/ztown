<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 18.07.12
 * Time: 20:27
 * @var \models\MapType $mapType
 * @var \models\Map $map
 * @var \components\View $this
 */

use components\Config;
use components\Html;

?>
<table class="default" cellpadding="0" cellspacing="0">
    <col width="100px">
    <col width="100px">
    <col>
    <tr>
        <th><?=$mapType->name;?> #<?=$map->level+1;?></th>
        <th colspan="2">Описание</th>
    </tr>
    <tr>
        <td align="center" rowspan="1">
            <?=Html::a($map->user->login, array('user/view', 'id' => $map->user->user_id));?><br/>
            <?=$this->render('//users/_avatar', array('user' => $map->user));?>
        </td>
        <td valign="top" colspan="2">
            <?=$mapType->info;?>
        </td>
    </tr>
    <?php if (false):?>
    <tr>
        <td>
            Наценка:
        </td>
        <td>
            <?php if ($map->user->user_id == $this->context->user->user_id): ?>
            <script language="JavaScript">
                $(document).ready(function(){
                    $('#navar').strackbar({
                        callback: function (value) {
                            $('#navar').find('.lgripper').html(value/10);
                            $.ajax({
                                type: "POST",
                                url:  "<?=Yii::$app->controller->getUrl('markUp');?>/markUp/" + value/10
                            });
                        },
                        defaultValue: <?=$map->markup*10;?>,
                        minValue: 0,
                        maxValue: <?=$mapType->markup_max*10;?>,
                        sliderHeight: 20,
                        sliderWidth: 350,
                        animate: false,
                        ticks: false,
                        labels: false,
                        trackerHeight: 26,
                        trackerWidth: 30
                    });
                });
            </script>
            <?php endif; ?>
            <input type="hidden" name="value" id="navar_edit" value="<?=$map->markup;?>">
            <input type="hidden" name="value" id="nenavar_edit" value="<?=100-$map->markup;?>">
            <div class="trackbar" id="navar"></div>
        </td>
    </tr>
    <?php endif;?>
    <?php if (false):?>
    <tr>
        <td colspan="2">
            Уровень здания <span style="color: green"><?=$map->level;?> </span>(развитие на уровне <span style="color: green"><?=min($map->getSubLevelsToLelelUp(), $map->sub_level);?>/<?=$map->getSubLevelsToLelelUp();?></span>)
            <?php if ($map->getSubLevelsToLelelUp() <= $map->sub_level):?>
            <?=Html::buttonWithHref(
                '+1 уровень',
                'images/info/update.png',
                Yii::$app->controller->getUrl('upgrade'),
                array('style' => 'float:right')
            );?>

            <?php endif;?>
        </td>
    </tr>
    <?php endif;?>
    <?php if (sizeof($map->mapWorks)>0):?>
    <?php foreach ($map->mapWorks as $mapWork):?>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo Html::img('/images/work/'.$mapWork->work->image);?></td>
        <td style="vertical-align: top">
            <b><?php echo $mapWork->work->title;?></b>
            <br>
            <?php echo $mapWork->work->description;?>
            <br>
            Осталось предложений: <?php echo $mapWork->count;?>
            <?=Html::moneyButton(
                   '',
                   'images/info/bay.png',
                   $mapWork->work->workBonus,
                   1,
                   array('href' => Yii::$app->controller->getUrl('doWork',array('id' => $mapWork->id)),'style'=>'float:right')
            );?>
        </td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    <?php if ($map->user->user_id == $this->context->user->user_id && $map->level < Config::MAX_UPDATE_BUILD_LEVEL): ?>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2">
                Вложить деньги в бизнес:
                <?=Html::buttonWithImage(
                    'Вложить',
                    'images/info/bay.png',
                    array('href' => Yii::$app->controller->getUrl('addWork'),'style'=>'float:right')
                );?>
            </td>
        </tr>
    <?php endif; ?>
    <?php if($map->user->user_id != $this->context->user->user_id && $mapType->can_build): ?>
    <tr>
        <td>&nbsp;</td>
        <td><?=$map->user_id ? 'Выкупить' : 'Купить';?>:</td>
        <td colspan="2" align="right">
            <?=Html::moneyButton(
                '',
                'images/info/bay.png',
                $mapType,
                $map->getMarkUp(),
                array('href' => Yii::$app->controller->getUrl('rebuy'))
            );?>
        </td>
    </tr>
    <?php endif; ?>

    <?php if(false && $this->context->user->group->Type == Groups::MAFIA && $mapType->can_take): ?>
    <tr>
        <td>&nbsp;</td>
        <td>
            Крыша:
        </td>
        <td align="right">
            <?php if($map->mafia):?>
                <?=Html::link($map->mafia->name, array('groups/view', 'id' => $map->mafia->id));?>
            <?php else:?>
                Отсутсвует
            <?php endif; ?>

            <?=Html::buttonWithHref(
                $map->mafia ? 'Забить стрелку' : 'Посадить на бабки',
                'images/info/box.png',
                Yii::$app->controller->getUrl('take')
            );?>
        </td>
    </tr>
    <?php endif; ?>

</table>