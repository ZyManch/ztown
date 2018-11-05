<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'battles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user1_id'); ?>
		<?php echo $form->textField($model,'user1_id'); ?>
		<?php echo $form->error($model,'user1_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user2_id'); ?>
		<?php echo $form->textField($model,'user2_id'); ?>
		<?php echo $form->error($model,'user2_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'win'); ?>
		<?php echo $form->textField($model,'win'); ?>
		<?php echo $form->error($model,'win'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->