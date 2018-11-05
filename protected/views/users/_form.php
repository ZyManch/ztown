<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'access'); ?>
		<?php echo $form->textField($model,'access',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'access'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->textField($model,'sex'); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_info'); ?>
		<?php echo $form->textField($model,'group_info',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'group_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Money'); ?>
		<?php echo $form->textField($model,'Money'); ?>
		<?php echo $form->error($model,'Money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Stat1'); ?>
		<?php echo $form->textField($model,'Stat1'); ?>
		<?php echo $form->error($model,'Stat1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Stat2'); ?>
		<?php echo $form->textField($model,'Stat2'); ?>
		<?php echo $form->error($model,'Stat2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Stat3'); ?>
		<?php echo $form->textField($model,'Stat3'); ?>
		<?php echo $form->error($model,'Stat3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Stat4'); ?>
		<?php echo $form->textField($model,'Stat4'); ?>
		<?php echo $form->error($model,'Stat4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Stat5'); ?>
		<?php echo $form->textField($model,'Stat5'); ?>
		<?php echo $form->error($model,'Stat5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Stat6'); ?>
		<?php echo $form->textField($model,'Stat6'); ?>
		<?php echo $form->error($model,'Stat6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bonus1'); ?>
		<?php echo $form->textField($model,'Bonus1'); ?>
		<?php echo $form->error($model,'Bonus1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bonus2'); ?>
		<?php echo $form->textField($model,'Bonus2'); ?>
		<?php echo $form->error($model,'Bonus2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bonus3'); ?>
		<?php echo $form->textField($model,'Bonus3'); ?>
		<?php echo $form->error($model,'Bonus3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bonus4'); ?>
		<?php echo $form->textField($model,'Bonus4'); ?>
		<?php echo $form->error($model,'Bonus4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bonus5'); ?>
		<?php echo $form->textField($model,'Bonus5'); ?>
		<?php echo $form->error($model,'Bonus5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bonus6'); ?>
		<?php echo $form->textField($model,'Bonus6'); ?>
		<?php echo $form->error($model,'Bonus6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->textField($model,'level'); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exp'); ?>
		<?php echo $form->textField($model,'exp'); ?>
		<?php echo $form->error($model,'exp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'info'); ?>
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
		<?php echo $form->labelEx($model,'last_visit'); ?>
		<?php echo $form->textField($model,'last_visit'); ?>
		<?php echo $form->error($model,'last_visit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_count'); ?>
		<?php echo $form->textField($model,'last_count'); ?>
		<?php echo $form->error($model,'last_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_loaded'); ?>
		<?php echo $form->textField($model,'page_loaded'); ?>
		<?php echo $form->error($model,'page_loaded'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->textField($model,'lang',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->