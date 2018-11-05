<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo Html::encode($data->userid); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('page')); ?>:</b>
	<?php echo Html::encode($data->page); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo Html::encode($data->content); ?>
	<br />


</div>