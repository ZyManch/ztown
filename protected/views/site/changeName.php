<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 14.04.13
 * Time: 8:59
 * @var $this Controller
 * @var $form CActiveForm
 * @var $model ChangeLoginForm
 * @var $currentLogin string
 */
?>
<h1>Смена логина</h1>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'change-login-form',
    'enableClientValidation'=>true,
    'enableAjaxValidation' => true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),

)); ?>

    <br/>

    <table>
        <tr>
            <td>Ваш текущий логин: <b><?php echo $currentLogin; ?></b></td>
        </tr>
        <tr>
            <td>Введите новый логин либо оставте поле пустым чтобы не менять логин</td>
        </tr>
        <tr>
            <td>
                <?php echo $form->textField($model,'login'); ?>
                <?php echo $form->error($model,'login'); ?>
            </td>
        </tr>
    </table>

    <div>
        <?php echo Html::submitButton('Далее'); ?>
    </div>

<?php $this->endWidget(); ?>
</div>
