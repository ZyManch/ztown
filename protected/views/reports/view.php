
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'user_first_id',
		'user_second_id',
		'Date',
		'Money',
	),
)); ?>
