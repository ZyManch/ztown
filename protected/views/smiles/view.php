
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file',
		'bbcode',
		'visible',
	),
)); ?>
