<div class="form">

<?php use components\Html;

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'arena-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lvl'); ?>
		<?php echo $form->textField($model,'lvl'); ?>
		<?php echo $form->error($model,'lvl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'registered'); ?>
		<?php echo $form->textField($model,'registered'); ?>
		<?php echo $form->error($model,'registered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'battle_id'); ?>
		<?php echo $form->textField($model,'battle_id'); ?>
		<?php echo $form->error($model,'battle_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->