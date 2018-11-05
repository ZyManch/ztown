<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'battles-user-form',
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
		<?php echo $form->labelEx($model,'battle_id'); ?>
		<?php echo $form->textField($model,'battle_id'); ?>
		<?php echo $form->error($model,'battle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stat1'); ?>
		<?php echo $form->textField($model,'stat1'); ?>
		<?php echo $form->error($model,'stat1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stat2'); ?>
		<?php echo $form->textField($model,'stat2'); ?>
		<?php echo $form->error($model,'stat2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stat3'); ?>
		<?php echo $form->textField($model,'stat3'); ?>
		<?php echo $form->error($model,'stat3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stat4'); ?>
		<?php echo $form->textField($model,'stat4'); ?>
		<?php echo $form->error($model,'stat4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stat5'); ?>
		<?php echo $form->textField($model,'stat5'); ?>
		<?php echo $form->error($model,'stat5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stat6'); ?>
		<?php echo $form->textField($model,'stat6'); ?>
		<?php echo $form->error($model,'stat6'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->