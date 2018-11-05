<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'courses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'currency',
		'price',
		'date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
