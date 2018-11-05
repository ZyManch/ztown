<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currencies-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r'); ?>
		<?php echo $form->textField($model,'r'); ?>
		<?php echo $form->error($model,'r'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'g'); ?>
		<?php echo $form->textField($model,'g'); ?>
		<?php echo $form->error($model,'g'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'b'); ?>
		<?php echo $form->textField($model,'b'); ?>
		<?php echo $form->error($model,'b'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course'); ?>
		<?php echo $form->textField($model,'course'); ?>
		<?php echo $form->error($model,'course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'default'); ?>
		<?php echo $form->textField($model,'default'); ?>
		<?php echo $form->error($model,'default'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->