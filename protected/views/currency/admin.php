<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'currencies-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'r',
		'g',
		'b',
		'course',
		/*
		'default',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
