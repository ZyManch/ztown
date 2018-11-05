<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'messages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_first_id',
		'user_second_id',
		'title',
		'content',
		'created',
		/*
		'readed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
