<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'user_first_id',
		'user_second_id',
		'Date',
		'Money',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
