<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mafia-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'group_id',
		'map_id',
		'user_id',
		'content',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
