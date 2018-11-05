
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'forum_id',
		'user_id',
		'content',
		'created',
	),
)); ?>
