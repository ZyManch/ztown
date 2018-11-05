<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'battles-big-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Side1'); ?>
		<?php echo $form->textField($model,'Side1',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'Side1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Side2'); ?>
		<?php echo $form->textField($model,'Side2',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'Side2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Date'); ?>
		<?php echo $form->textField($model,'Date'); ?>
		<?php echo $form->error($model,'Date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Win'); ?>
		<?php echo $form->textField($model,'Win'); ?>
		<?php echo $form->error($model,'Win'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->