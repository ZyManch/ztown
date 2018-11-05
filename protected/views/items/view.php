
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'content',
		'type',
		'group',
		'delonuse',
		'price',
	),
)); ?>
