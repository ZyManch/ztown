<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'income-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'UserID',
		'UserIncome',
		'Time',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
