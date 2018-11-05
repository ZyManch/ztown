<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('X')); ?>:</b>
	<?php echo Html::encode($data->x); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Y')); ?>:</b>
	<?php echo Html::encode($data->y); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Type')); ?>:</b>
	<?php echo Html::encode($data->Type); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('roof_id')); ?>:</b>
	<?php echo Html::encode($data->roof_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('street')); ?>:</b>
	<?php echo Html::encode($data->street); ?>
	<br />

	<?php /*
	<b><?php echo Html::encode($data->getAttributeLabel('house')); ?>:</b>
	<?php echo Html::encode($data->house); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('LastSell')); ?>:</b>
	<?php echo Html::encode($data->LastSell); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('markup')); ?>:</b>
	<?php echo Html::encode($data->markup); ?>
	<br />

	*/ ?>

</div>