<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user1_id')); ?>:</b>
	<?php echo Html::encode($data->user1_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user2_id')); ?>:</b>
	<?php echo Html::encode($data->user2_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo Html::encode($data->date); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('win')); ?>:</b>
	<?php echo Html::encode($data->win); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo Html::encode($data->price); ?>
	<br />


</div>