<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'map-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->textField($model,'Type'); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'roof_id'); ?>
		<?php echo $form->textField($model,'roof_id'); ?>
		<?php echo $form->error($model,'roof_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'house'); ?>
		<?php echo $form->textField($model,'house'); ?>
		<?php echo $form->error($model,'house'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastSell'); ?>
		<?php echo $form->textField($model,'LastSell'); ?>
		<?php echo $form->error($model,'LastSell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'markup'); ?>
		<?php echo $form->textField($model,'markup'); ?>
		<?php echo $form->error($model,'markup'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->