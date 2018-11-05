<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stats-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'stat1',
		'stat2',
		'stat3',
		'stat4',
		'stat5',
		/*
		'stat6',
		'bonus1',
		'bonus2',
		'bonus3',
		'bonus4',
		'bonus5',
		'bonus6',
		'status',
		'changed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
