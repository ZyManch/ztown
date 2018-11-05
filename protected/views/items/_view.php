<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo Html::encode($data->name); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo Html::encode($data->content); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo Html::encode($data->type); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('group')); ?>:</b>
	<?php echo Html::encode($data->group); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('delonuse')); ?>:</b>
	<?php echo Html::encode($data->delonuse); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo Html::encode($data->price); ?>
	<br />


</div>