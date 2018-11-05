<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo Html::encode($data->currency); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo Html::encode($data->parent_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo Html::encode($data->value); ?>
	<br />


</div>