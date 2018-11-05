<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('battle_id')); ?>:</b>
	<?php echo Html::encode($data->battle_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo Html::encode($data->user); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo Html::encode($data->text); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('damag')); ?>:</b>
	<?php echo Html::encode($data->damag); ?>
	<br />


</div>