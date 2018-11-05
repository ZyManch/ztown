
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'currency',
		'parent_id',
		'value',
	),
)); ?>
