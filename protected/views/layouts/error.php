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
<?php echo $content; ?>
<div class="footer">
    <div class="spacer">ZyManch (c)</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>