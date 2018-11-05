<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'content',
		'type',
		'group',
		'delonuse',
		/*
		'price',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
