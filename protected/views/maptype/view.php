
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'controller',
		'name',
		'info',
		'can_build',
		'can_take',
		'price',
		'UserIncome'
	),
)); ?>
