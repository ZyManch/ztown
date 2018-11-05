<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'friends-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'User1',
		'User2',
		'Confirm',
		'Type',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
