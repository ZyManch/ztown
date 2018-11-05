<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smiles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->textField($model,'file',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bbcode'); ?>
		<?php echo $form->textField($model,'bbcode',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'bbcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->textField($model,'visible'); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->