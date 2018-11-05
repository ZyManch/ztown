<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'army-names-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'type',
		'position',
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
