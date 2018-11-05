<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'houses-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'X'); ?>
		<?php echo $form->textField($model,'X'); ?>
		<?php echo $form->error($model,'X'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Y'); ?>
		<?php echo $form->textField($model,'Y'); ?>
		<?php echo $form->error($model,'Y'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textField($model,'info',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->