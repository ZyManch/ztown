
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'battle_id',
		'user',
		'text',
		'damag',
	),
)); ?>
