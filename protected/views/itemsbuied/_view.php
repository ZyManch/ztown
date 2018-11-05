<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo Html::encode($data->item_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('used')); ?>:</b>
	<?php echo Html::encode($data->used); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo Html::encode($data->level); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('light')); ?>:</b>
	<?php echo Html::encode($data->light); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('bonus1')); ?>:</b>
	<?php echo Html::encode($data->bonus1); ?>
	<br />

	<?php /*
	<b><?php echo Html::encode($data->getAttributeLabel('bonus2')); ?>:</b>
	<?php echo Html::encode($data->bonus2); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('bonus3')); ?>:</b>
	<?php echo Html::encode($data->bonus3); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('bonus4')); ?>:</b>
	<?php echo Html::encode($data->bonus4); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('bonus5')); ?>:</b>
	<?php echo Html::encode($data->bonus5); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('bonus6')); ?>:</b>
	<?php echo Html::encode($data->bonus6); ?>
	<br />

	*/ ?>

</div>