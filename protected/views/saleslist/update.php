<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */

$this->breadcrumbs=array(
	'Saleslists'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Saleslist', 'url'=>array('index')),
	array('label'=>'Create Saleslist', 'url'=>array('create')),
	array('label'=>'View Saleslist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Saleslist', 'url'=>array('admin')),
);
?>

<h1>Update Saleslist <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>