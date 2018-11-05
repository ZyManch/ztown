<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reports-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_first_id'); ?>
		<?php echo $form->textField($model,'user_first_id'); ?>
		<?php echo $form->error($model,'user_first_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_second_id'); ?>
		<?php echo $form->textField($model,'user_second_id'); ?>
		<?php echo $form->error($model,'user_second_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Date'); ?>
		<?php echo $form->textField($model,'Date'); ?>
		<?php echo $form->error($model,'Date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Money'); ?>
		<?php echo $form->textField($model,'Money'); ?>
		<?php echo $form->error($model,'Money'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->