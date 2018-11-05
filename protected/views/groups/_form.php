<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lower_name'); ?>
		<?php echo $form->textField($model,'lower_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'lower_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->textField($model,'Type',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Mens'); ?>
		<?php echo $form->textField($model,'Mens'); ?>
		<?php echo $form->error($model,'Mens'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CanTake'); ?>
		<?php echo $form->textField($model,'CanTake'); ?>
		<?php echo $form->error($model,'CanTake'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Taked'); ?>
		<?php echo $form->textField($model,'Taked'); ?>
		<?php echo $form->error($model,'Taked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Balls'); ?>
		<?php echo $form->textField($model,'Balls'); ?>
		<?php echo $form->error($model,'Balls'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->