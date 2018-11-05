<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('file')); ?>:</b>
	<?php echo Html::encode($data->file); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('bbcode')); ?>:</b>
	<?php echo Html::encode($data->bbcode); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('visible')); ?>:</b>
	<?php echo Html::encode($data->visible); ?>
	<br />


</div>