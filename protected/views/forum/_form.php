<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forum-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibled'); ?>
		<?php echo $form->textField($model,'visibled'); ?>
		<?php echo $form->error($model,'visibled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enabled'); ?>
		<?php echo $form->textField($model,'enabled'); ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_topics'); ?>
		<?php echo $form->textField($model,'is_topics'); ?>
		<?php echo $form->error($model,'is_topics'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topics'); ?>
		<?php echo $form->textField($model,'topics'); ?>
		<?php echo $form->error($model,'topics'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
		<?php echo $form->error($model,'updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->