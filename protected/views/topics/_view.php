<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('forum_id')); ?>:</b>
	<?php echo Html::encode($data->forum_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo Html::encode($data->content); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo Html::encode($data->created); ?>
	<br />


</div>