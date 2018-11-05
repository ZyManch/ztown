<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'topics-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'forum_id',
		'user_id',
		'content',
		'created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
