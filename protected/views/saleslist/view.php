<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */

$this->breadcrumbs=array(
	'Saleslists'=>array('index'),
	$model->id,
);

$this->menu=array(	
	array('label'=>'Create Saleslist', 'url'=>array('create')),
	array('label'=>'Manage Saleslist', 'url'=>array('admin')),
	array('label'=>'Import CSV', 'url'=>array('csvImport')),
);
?>

<h1>View Saleslist #<?php echo $model->customerName; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'customerName',
		'productName',
		'date',	
		array(
			'name'=>'crBy',
			'value'=>$model->crBy0->name,
		),
		'crDate',		
		array(
			'name'=>'Status',
			'value'=>$model->status0->status,
		),
	),
)); ?>
