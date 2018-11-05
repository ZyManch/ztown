<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo Html::encode($data->type); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo Html::encode($data->position); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo Html::encode($data->name); ?>
	<br />


</div>