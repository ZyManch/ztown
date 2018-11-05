<?php
/**
 * @var $this \components\View
 * @var $form ActiveForm
 * @var $model \forms\LoginForm
 */

use components\Html;
use yii\bootstrap\ActiveForm;

?>
<h1>Авторизация</h1>

<div class="form">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'm-t', 'role' => 'form']]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required'])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required'])->label(false) ?>

    <?= Html::hiddenInput('LoginForm[rememberMe]',1); ?>

    <div class="form-group">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary block', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
