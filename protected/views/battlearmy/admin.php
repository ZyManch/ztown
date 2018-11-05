<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battle-army-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'parent_id',
		'battle_id',
		'stat',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
