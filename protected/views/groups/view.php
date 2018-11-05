
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'lower_name',
		'Type',
		'Mens',
		'CanTake',
		'Taked',
		'Balls',
	),
)); ?>
