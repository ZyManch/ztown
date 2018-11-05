<?php
/**
 * @var $this \components\View
 * @var \models\Money $money
 */

use components\Config;
use components\Html;

assets\AppAsset::register($this);
if(!$this->title){
    $this->title = Yii::$app->name;
};
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <base href="<?php echo \Yii::$app->request->baseUrl; ?>/"/>
    <title><?= Html::encode($this->title) ?></title>
    <META http-equiv="Content-Type" content="text/html; charset=utf8"/>
    <link rel="icon" href="/favicon.ico" />
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <?php if(isset(Yii::$app->params['analytics'])):?>
        <?=$this->render('//layouts/analytics');?>
    <?php endif;?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="message_box"></div>
<div class="header"></div>
<div class="menuline"></div>
<?=$this->render('_menu');?>

<?php if(!Yii::$app->user->isGuest): ?>
    <div class="user_menu">
        <div class="item">
            <div class="text">
                <?=models\Currency::getDefaultValute()->title ;?>:
                <?=$this->render('//users/_money', array('money' => $this->context->user->getStorage()->getMoney(models\Currency::getDefaultValute()->currency_id)));?>
            </div>
            <div class="submenu">
                <?php foreach ($this->context->user->getStorage()->getMoneys() as $currencyId => $money):?>
                <?php if ($currencyId != Config::VALUTA_ID_DEFAULT):?>
                <?php $currency = \models\Currency::getValutes($currencyId);?>
                <div>
                    <?=$currency->title ;?>:
                    <?=$this->render('//users/_money', array('money' => $money, 'currencyId' => $currency->currency_id));?>
                    <?php if ($currency->weight):?>
                        [<?=$currency->weight;?>]
                    <?php endif;?>
                </div>
                <?php endif;?>
                <?php endforeach;?>
                <div><?=Html::a('Доход в день', array('income/stats'));?></div>
                <div><?=Html::a('Операции', array('reports/index'));?></div>
            </div>
        </div>
        <div class="item">
            <div class="text">
                <?=Html::a('Сообщения', array('messages/index'));?>
            </div>
            <div class="submenu">
                <div><?=Html::a('Входящие сообщения', array('messages/index'));?></div>
                <div><?=Html::a('Отправленые сообщения', array('messages/outcome'));?></div>
            </div>
        </div>
        <div class="item">
            <div class="text">
                <?=Html::a('Друзья', array('friends/index'));?>
            </div>
            <div class="submenu">
                <div><?=Html::a('Друзья онлайн', array('friends/online'));?></div>
            </div>
        </div>
    </div>
<?php endif;?>

<div class="content">
    <div class="spacer" id="content">
        <?php if ($status = Yii::$app->session->getFlash('status')):?>
            <div class="status">
                <?=$status;?>
                <div><button onclick="$(this).parents('.status').hide();return false;">Закрыть</button></div>
            </div>
        <?php endif;?>
        <?php echo $content; ?>
    </div>
</div>

<?php
if(isset($_SESSION['message'])){
    ?>
<div class="confirm">
    <div>
        <?=$_SESSION['message'];?><br>
        <input type="button" value="OK" onclick="$(this).parent().parent().remove();" style="float:right">
    </div>

</div>
    <?php
    unset($_SESSION['message']);
}
?>
<div class="footer">
    <div class="spacer">ZyManch (c)</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>