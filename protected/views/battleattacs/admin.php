<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battle-attacs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'battle_id',
		'user',
		'text',
		'damag',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
