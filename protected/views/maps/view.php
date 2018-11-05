
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'X',
		'Y',
		'Type',
		'user_id',
		'roof_id',
		'street',
		'house',
		'LastSell',
		'markup',
	),
)); ?>
