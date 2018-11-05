<div class="view">

	<b><?php use components\Html;

        echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('lvl')); ?>:</b>
	<?php echo Html::encode($data->lvl); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('registered')); ?>:</b>
	<?php echo Html::encode($data->registered); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('battle_id')); ?>:</b>
	<?php echo Html::encode($data->battle_id); ?>
	<br />


</div>