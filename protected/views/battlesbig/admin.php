<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battles-big-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'Side1',
		'Side2',
		'Date',
		'Win',
		'price',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
