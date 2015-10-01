<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */

$this->breadcrumbs=array(
	'Saleslists'=>array('index'),
	'Create',
);

$this->menu=array(	
	array('label'=>'Manage Saleslist', 'url'=>array('admin')),
	array('label'=>'Import CSV', 'url'=>array('csvImport')),
);
?>

<h1>Create Saleslist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>