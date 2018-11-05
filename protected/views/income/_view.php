<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo Html::encode($data->UserID); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('UserIncome')); ?>:</b>
	<?php echo Html::encode($data->UserIncome); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Time')); ?>:</b>
	<?php echo Html::encode($data->Time); ?>
	<br />


</div>