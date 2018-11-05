<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('autor_id')); ?>:</b>
	<?php echo Html::encode($data->autor_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo Html::encode($data->group_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo Html::encode($data->date); ?>
	<br />


</div>