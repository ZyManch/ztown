<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stats-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'changed'); ?>
		<?php echo $form->textField($model,'changed'); ?>
		<?php echo $form->error($model,'changed'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->