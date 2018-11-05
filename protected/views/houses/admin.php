<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'houses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_id',
		'X',
		'Y',
		'info',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
