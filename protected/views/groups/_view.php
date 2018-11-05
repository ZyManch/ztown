<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo Html::encode($data->name); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('lower_name')); ?>:</b>
	<?php echo Html::encode($data->lower_name); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Type')); ?>:</b>
	<?php echo Html::encode($data->Type); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Mens')); ?>:</b>
	<?php echo Html::encode($data->Mens); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('CanTake')); ?>:</b>
	<?php echo Html::encode($data->CanTake); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Taked')); ?>:</b>
	<?php echo Html::encode($data->Taked); ?>
	<br />

	<?php /*
	<b><?php echo Html::encode($data->getAttributeLabel('Balls')); ?>:</b>
	<?php echo Html::encode($data->Balls); ?>
	<br />

	*/ ?>

</div>