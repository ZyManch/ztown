<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'income-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID'); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserIncome'); ?>
		<?php echo $form->textField($model,'UserIncome'); ?>
		<?php echo $form->error($model,'UserIncome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Time'); ?>
		<?php echo $form->textField($model,'Time'); ?>
		<?php echo $form->error($model,'Time'); ?>
	</div>

	<div class="row buttons">
		<?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->