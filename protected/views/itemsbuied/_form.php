<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-buied-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
		<?php echo $form->error($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'used'); ?>
		<?php echo $form->textField($model,'used'); ?>
		<?php echo $form->error($model,'used'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->textField($model,'level'); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'light'); ?>
		<?php echo $form->textField($model,'light',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'light'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus1'); ?>
		<?php echo $form->textField($model,'bonus1'); ?>
		<?php echo $form->error($model,'bonus1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus2'); ?>
		<?php echo $form->textField($model,'bonus2'); ?>
		<?php echo $form->error($model,'bonus2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus3'); ?>
		<?php echo $form->textField($model,'bonus3'); ?>
		<?php echo $form->error($model,'bonus3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus4'); ?>
		<?php echo $form->textField($model,'bonus4'); ?>
		<?php echo $form->error($model,'bonus4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus5'); ?>
		<?php echo $form->textField($model,'bonus5'); ?>
		<?php echo $form->error($model,'bonus5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus6'); ?>
		<?php echo $form->textField($model,'bonus6'); ?>
		<?php echo $form->error($model,'bonus6'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->