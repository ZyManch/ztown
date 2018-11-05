<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'arena-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'lvl',
		'registered',
		'battle_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
