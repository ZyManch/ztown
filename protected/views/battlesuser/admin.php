<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'battles-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'battle_id',
		'stat1',
		'stat2',
		'stat3',
		/*
		'stat4',
		'stat5',
		'stat6',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
