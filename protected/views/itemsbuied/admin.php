<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-buied-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'item_id',
		'user_id',
		'used',
		'level',
		'light',
		/*
		'bonus1',
		'bonus2',
		'bonus3',
		'bonus4',
		'bonus5',
		'bonus6',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
