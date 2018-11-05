<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 08.07.12
 * Time: 12:31
 * To change this template use File | Settings | File Templates.
 * @var User $user
 */
?>
Пользователь <?=$user->login;?> предлагает Вам свое сердце, и просит Вашей руки.
Если Вы согласны, перейдите по ссылке
<?=Html::a('ссылке', $this->getUrl('accept', array('id' => $user->id)));?>,
иначе по <?=Html::a('этой', $this->getUrl('decline', array('id' => $user->id)));?>