<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo Html::encode($data->group_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('map_id')); ?>:</b>
	<?php echo Html::encode($data->map_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo Html::encode($data->content); ?>
	<br />


</div>