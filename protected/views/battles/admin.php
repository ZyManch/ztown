<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battles-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user1_id',
		'user2_id',
		'date',
		'win',
		'price',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
