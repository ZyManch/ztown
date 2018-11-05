<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-opened-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'item_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
