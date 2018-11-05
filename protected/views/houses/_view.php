<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo Html::encode($data->group_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('X')); ?>:</b>
	<?php echo Html::encode($data->x); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Y')); ?>:</b>
	<?php echo Html::encode($data->y); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('info')); ?>:</b>
	<?php echo Html::encode($data->info); ?>
	<br />


</div>