<div class="view">

	<b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo Html::a(Html::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo Html::encode($data->title); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo Html::encode($data->parent_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo Html::encode($data->user_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo Html::encode($data->group_id); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('visibled')); ?>:</b>
	<?php echo Html::encode($data->visibled); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('enabled')); ?>:</b>
	<?php echo Html::encode($data->enabled); ?>
	<br />

	<?php /*
	<b><?php echo Html::encode($data->getAttributeLabel('is_topics')); ?>:</b>
	<?php echo Html::encode($data->is_topics); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo Html::encode($data->position); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('topics')); ?>:</b>
	<?php echo Html::encode($data->topics); ?>
	<br />

	<b><?php echo Html::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo Html::encode($data->updated); ?>
	<br />

	*/ ?>

</div>