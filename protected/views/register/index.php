<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 13.01.13
 * Time: 9:55
 * @var $this \components\View
 * @var $avatars Avatars[]
 * @var $model \forms\RegisterForm
 * @var $form ActiveForm
 */

use components\Html;
use yii\bootstrap\ActiveForm;

?>
<h1>Регистрация</h1>

<div>
    Зарегистрироваться, используя существующие аккаунты:
    <?=$this->render('oauth');?>
</div>


<hr>
<div class="form">
    <?php $form = ActiveForm::begin(['id' => 'register-form', 'options' => ['class' => 'm-t', 'role' => 'form']]); ?>

        <?= $form->field($model, 'login')->textInput(['class' => 'form-control', 'required' => 'required']) ?>
        <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'required' => 'required']) ?>
        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'required' => 'required']) ?>
        <?= $form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control', 'required' => 'required']) ?>
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
