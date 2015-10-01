<?php
/* @var $this SaleslistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Saleslists',
);

$this->menu=array(
	array('label'=>'Create Saleslist', 'url'=>array('create')),
	array('label'=>'Manage Saleslist', 'url'=>array('admin')),
);
?>

<h1>Saleslists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
