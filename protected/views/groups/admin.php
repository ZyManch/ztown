<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'groups-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'lower_name',
		'Type',
		'Mens',
		'CanTake',
		/*
		'Taked',
		'Balls',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
