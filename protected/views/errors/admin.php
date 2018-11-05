<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'errors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'userid',
		'page',
		'content',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
