<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Side1')); ?>:</b>
	<?php echo Html::encode($data->Side1); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Side2')); ?>:</b>
	<?php echo Html::encode($data->Side2); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Date')); ?>:</b>
	<?php echo Html::encode($data->Date); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('Win')); ?>:</b>
	<?php echo Html::encode($data->Win); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo Html::encode($data->price); ?>
	<br />


</div>