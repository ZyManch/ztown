
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'parent_id',
		'user_id',
		'group_id',
		'visibled',
		'enabled',
		'is_topics',
		'position',
		'topics',
		'updated',
	),
)); ?>
