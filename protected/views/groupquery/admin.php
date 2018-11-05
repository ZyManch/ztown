<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-query-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'autor_id',
		'user_id',
		'group_id',
		'date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
