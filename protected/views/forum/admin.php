<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'forum-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'parent_id',
		'user_id',
		'group_id',
		'visibled',
		/*
		'enabled',
		'is_topics',
		'position',
		'topics',
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
