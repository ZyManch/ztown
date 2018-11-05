<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo Html::encode($data->item_id); ?>
	<br />


</div>