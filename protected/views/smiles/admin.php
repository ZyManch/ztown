<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smiles-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'file',
		'bbcode',
		'visible',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
