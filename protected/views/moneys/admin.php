<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moneys-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'currency',
		'parent_id',
		'value',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
