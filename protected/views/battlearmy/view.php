
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'parent_id',
		'battle_id',
		'stat',
	),
)); ?>
