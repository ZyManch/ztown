<?php
/**
 * @var CController $this
 * @var Battles $battle
 * @var BattleAttacs $attack
 */
$userLeft = $battle->userLeft;
$userRight = $battle->userRight;
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th width="200px"><?=$battle->userLeft->user->login;?></th>
        <th>Логи боя</th>
        <th width="200px"><?=$battle->userRight->user->login;?></th>
    </tr>
    <tr>
        <td rowspan="2" valign="top">
            <div style="text-align:center">
                <?=$this->render('//users/_avatar', array('user' => $battle->userLeft->user));?>
            </div>
            <div class="hp_max left-side">
                <div class="hp"></div>
                <?php $hp = Yii::$app->config->getHp($userLeft->stat->getSumm(2));?>
                <div class="text"><?=$hp.'/'.$hp;?></div>
            </div>
            <div style="margin:0px 5px;">
                <?php for($i=1;$i<=6;$i++):?>
                <?=$this->render('//users/_stat', array('user'=>$userLeft->user, 'statId' => $i));?><br/>
                <?php endfor;?>
            </div>
        </td>
        <td>&nbsp;</td>
        <td rowspan="2" valign="top">
            <div style="text-align:center">
                <?=$this->render('//users/_avatar', array('user' => $battle->userRight->user));?>
            </div>
            <div class="hp_max right-side">
                <div class="hp"></div>
                <?php $hp = Yii::$app->config->getHp($userRight->stat->getSumm(2));?>
                <div class="text"><?=$hp.'/'.$hp;?></div>
            </div>
            <div style="margin:0px 5px;">
                <?php for($i=1;$i<=6;$i++):?>
                <?=$this->render('//users/_stat', array('user'=>$userRight->user, 'statId' => $i));?><br/>
                <?php endfor;?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="1" valign="top">
            <table cellpadding="0" cellspacing="0" style="width:300px">
                <tr><th>Битва</th></tr>
                <tr>
                    <td style="display:none" class="td0">
                        Победитель <span class="red_text"><?=$battle->win_side == Battles::SIDE_LEFT ? $battle->userLeft->user->login : $battle->userRight->user->login;?></span>.<br>
                        Награда :
                        <ul>
                            <?php foreach ($battle->prizes as $prize):?>
                            <li><?=$prize;?></li>
                            <?php endforeach;?>
                        </ul>
                    </td>
                </tr>
                <?php
                $attacks = array_reverse($battle->attacks);
                foreach($attacks as $i => $attack):?>
                    <tr>
                        <td style="display:none" class="td<?=$attack->step;?>">
                            <?php
                            $isFirstUser = $attack->from_user_id == $battle->userLeft->user_id;
                            echo $this->render('//battles/_attack', array(
                                'userLeft' => $attack->fromUser->login,
                                'userRight' => $attack->toUser->login,
                                'damage' => $attack->power,
                                'text'  => $attack->text
                            ));
                            ?>
                        </td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td>
						<span class="red_text">
							<?=$battle->userLeft->user->login;?>
						</span>
                        VS
						<span class="red_text">
							<?=$battle->userRight->user->login;?>
						</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>