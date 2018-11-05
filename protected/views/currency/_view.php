<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo Html::encode($data->title); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('r')); ?>:</b>
	<?php echo Html::encode($data->r); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('g')); ?>:</b>
	<?php echo Html::encode($data->g); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('b')); ?>:</b>
	<?php echo Html::encode($data->b); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('course')); ?>:</b>
	<?php echo Html::encode($data->course); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('default')); ?>:</b>
	<?php echo Html::encode($data->default); ?>
	<br />


</div>