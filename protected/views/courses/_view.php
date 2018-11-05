<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('currency')); ?>:</b>
	<?php echo Html::encode($data->currency); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo Html::encode($data->price); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo Html::encode($data->date); ?>
	<br />


</div>