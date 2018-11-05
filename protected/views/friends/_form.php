<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'friends-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'User1'); ?>
		<?php echo $form->textField($model,'User1'); ?>
		<?php echo $form->error($model,'User1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'User2'); ?>
		<?php echo $form->textField($model,'User2'); ?>
		<?php echo $form->error($model,'User2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Confirm'); ?>
		<?php echo $form->textField($model,'Confirm'); ?>
		<?php echo $form->error($model,'Confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->textField($model,'Type',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->