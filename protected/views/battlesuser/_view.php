<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('battle_id')); ?>:</b>
	<?php echo Html::encode($data->battle_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('stat1')); ?>:</b>
	<?php echo Html::encode($data->stat1); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('stat2')); ?>:</b>
	<?php echo Html::encode($data->stat2); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('stat3')); ?>:</b>
	<?php echo Html::encode($data->stat3); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('stat4')); ?>:</b>
	<?php echo Html::encode($data->stat4); ?>
	<br />

	<?php /*
	<b><?php echo Html::encode($data->getAttributeLabel('stat5')); ?>:</b>
	<?php echo Html::encode($data->stat5); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('stat6')); ?>:</b>
	<?php echo Html::encode($data->stat6); ?>
	<br />

	*/ ?>

</div>