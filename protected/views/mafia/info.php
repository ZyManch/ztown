<?php
/**
 * @var array $members
 * @var User $member
 * @var User $head
 * @var Groups $group
 * @var CActiveForm $form
 * @var int $id
 */
$isHead = Yii::$app->user->getId() == $head->id;
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'action' => $this->getUrl('update'),
    'enableAjaxValidation' => false
)); ?>
    <table class="default" cellpadding="0" cellspacing="0" id="addworks">
        <col width="30px"/>
        <col width="250px"/>
        <col width="370px"/>
        <tr>
            <th colspan="3">Группировка</th>
        </tr>
        <tr>
            <td valign="top" colspan="2">
                <div>
                    Главный: <?=$head->login;?>
                </div>
            </td>
            <td valign="top">
                <?php if ($isHead): ?>
                    <div><?=$form->textArea($group->mafiaInfo, 'content', array('rows' => 10, 'cols' => 50));?></div>
                    <div><?=Html::submitButton('Сохранить').CHtml::resetButton('Отменить');?></div>
                <?php else: ?>
                    <?=nl2br($group->mafiaInfo->content);?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th colspan="3">Погоняло вора</th>
        </tr>
        <?php foreach ($members as $pos => $member):?>
            <tr>
                <td align="center">
                    <?php if($isHead && $member->id != Yii::$app->user->getId()): ?>
                    <a href=""><img src="images/info/delete.png"></a>
                    <?php else:?>
                    <?=$pos + 1;?>
                    <?php endif; ?>
                </td>
                <td>
                    <div>
                        <?php if($isHead): ?>
                        <?=CHtml::textField('user['.$member->id.']', $member->group_info);?>
                        <?php else: ?>
                        <?=$member->group_info;?>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?=$this->render('//users/_avatar', array('user' => $member, 'ancor' => true));?>
                    </div>
                </td>
                <td>
                    <div><?=Items::statLabels(2);?>: <?=$member->stat->getSumm(2);?></div>
                    <div><?=Items::statLabels(3);?>: <?=$member->stat->getSumm(3);?></div>
                    <div>Молодых: <?=sizeof($member->army);?></div>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php if($isHead): ?>
        <tr>
            <td colspan="3" align="center">
                <div><?=Html::submitButton('Сохранить').CHtml::resetButton('Отменить');?></div>
            </td>
        </tr>
        <?php endif; ?>
    </table>
<?php $this->endWidget(); ?>