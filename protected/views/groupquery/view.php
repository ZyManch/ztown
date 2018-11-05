
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'autor_id',
		'user_id',
		'group_id',
		'date',
	),
)); ?>
