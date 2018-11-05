
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'user_id',
		'used',
		'level',
		'light',
		'bonus1',
		'bonus2',
		'bonus3',
		'bonus4',
		'bonus5',
		'bonus6',
	),
)); ?>
