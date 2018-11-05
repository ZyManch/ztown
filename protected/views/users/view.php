<?php
/**
 * @var bool $canEdit
 * @var models\User $model
 * @var \components\View $this
 */

use components\Html;
use yii\helpers\Url;

$this->registerCssFile('/css//profile.css');
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th width="200px">Пользователь</th>
        <th>#</th>
        <th>Профиль</th>
    </tr>

    <tr>
        <td valign="top" align="center">
            <div>
                <?=$this->render('//users/_avatar', array(
                    'user' => $model,
                    'ancor' => false
                ));?>
            </div>
            <div>
                <?php if($model->isAdmin()):?>Админ<?php else: ?>Пользователь<?php endif;?>:
            </div>
            <div>
                <?=Html::a(
                    $model->login,
                    array('users/view', 'id' => $model->id)
                );?>
            </div>
            <hr>
            <div class="left_margin">
                <?=$this->render('//stats/_view', array(
                    'stat' => $model->stat
                ));?>
            </div>
        </td>
        <td valign="top">
            <?php if($canEdit): ?>
            <form action="<?= Url::to(array('users/update-info', 'id'=>$model->id));?>" method="post">
                <textarea name="info" style="width:100%;height:400px;"><?=$model->info;?></textarea>
                <input type="submit" name="save" value="Сохранить"><input type="reset" name="save" value="Отмена">
                <?=Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []);?>
            </form>
            <?php else: ?>
            <?=nl2br($model->info);?>&nbsp;
            <?php endif; ?>
        </td>
        <td valign="top">
            <div class="equipence">
                <?=$this->render('//users/_profile', array('user' => $model));?>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <?php if($model->id != Yii::$app->user->id): ?>
            <div>
                <?=Html::buttonWithHref(
                    'Написать сообщение',
                    'images/info/letter.png',
                    array('messages/create', 'id' => $model->id)
                );?></div>
            <?php $friend = $model->getFriend();?>
            <?php if($friend): ?>
                <?php if(!$friend->Confirm && ($friend->User1 == $model->id)): ?>
                    <div>
                        <?=Html::buttonWithHref(
                            'Принять приглашение',
                            'images/info/friend.png',
                            array('friends/accept', 'id' => $model->id)
                        );?>
                    </div>

                    <div>
                        <?=Html::buttonWithHref(
                            'Удалить из друзей',
                            'images/info/delete.png',
                            array('friends/delete', 'id' => $model->id)
                        );?>
                    </div>
                    <?php else: ?>
                    <div>
                        <?=Html::buttonWithHref(
                        'Удалить из друзей',
                        'images/info/delete.png',
                        array('friends/delete', 'id' => $model->id)
                    );?><button onclick="location.href='index.php?action=friends&event=delete&id=<?=$model->id;?>';">
                        <img src="images/info/delete.png"> Удалить из друзей
                    </button></div>
                    <?php endif; ?>
                <?php else: ?>
                <div><button onclick="location.href='index.php?action=friends&event=add&id=<?=$model->id;?>'">
                    <img src="images/info/friend.png"> Добавить в друзья
                </button></div>
                <?php endif; ?>
            <div>
                <button onclick="location.href='index.php?action=message&event=money&id=<?=$model->id;?>';">
                    <img src="images/info/bay.png"> Послать деньги
                </button>
            </div>
            <?php else: ?>
            &nbsp;
            <?php endif; ?>
        </td>
        <td align="center" colspan="2">
            <?php if($model->id == Yii::$app->user->getId()): ?>
                <table cellpadding="0" cellspacing="0" class="bug">
                    <tr>
                        <th colspan="6">Рюкзак</th>
                    </tr>
                    <?php for($i=0,$n=count($model->itemBuieds);$i<$n;$i+=6):?>
                        <tr>
                        <?php for($j=0;$j<6;$j++):?>
                            <?php $item = $model->itemBuieds[$i + $j];?>
                            <?php if($item):?>
                                <td>
                                    <?=$this->render('//itemsbuied/_item', array(
                                        'type' => '',
                                        'info' => $item
                                    ));?>
                                    <?php echo Html::buttonWithHref(
                                        $item->used ? 'Снять' : 'Одеть',
                                        '',
                                        array('/itemsbuied/use', 'id' => $item->id)
                                    );?>
                                </td>
                            <?php else:?>
                                <td>&nbsp;</td>
                            <?php endif;?>
                        <?php endfor;?>
                        </tr>
                    <?php endfor;?>
                </table>
                <?php else:?>
                    <?php if($model->group):?>
                        <?=$model->group->groupLabel();?>:<br>
                        <a href="index.php?action=group&id=<?=$model->group->id;?>"><?=$model->group->name;?></a>
                    <?php else: ?>
                    <?php if(Yii::$app->user->group->isHead()):?>
                        <?php $invite = Yii::$app->user->group->getInviteInfo($model->id);?>
                        <?php if($invite): ?>
                            <button onclick="location.href='index.php?action=group&event=add&id=<?=$model->id;?>';" disabled>
                                Ожидание ответа
                            </button>
                            <?php else: ?>
                            <button onclick="location.href='index.php?action=group&event=add&id=<?=$model->id;?>';">
                                <?=Yii::$app->user->group->inviteLabel();?>
                            </button>
                            <?php endif;?>
                    <?php else:?>
                        Не в группе
                    <?php endif;?>
                <?php endif;?>
            <?php endif;?>
        </td>
    </tr>
</table>