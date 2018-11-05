<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo Html::encode($data->name); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo Html::encode($data->parent_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('stat')); ?>:</b>
	<?php echo Html::encode($data->stat); ?>
	<br />


</div>