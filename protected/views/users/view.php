<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(	
	array('label'=>'Add User', 'url'=>array('create')),	
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'name',
		'username',
		'password',
		'enKey',
		'email',		
		array(
			'name'=>'typeId',
			'value'=>($model->typeId==1) ? 'Admin' : 'User',
		),
		'ipAddress',
		'loginCount',
		//'crBy',
		/*array(
			'name'=>'Status',
			'value'=>Users::model()->findByPk($model->crBy)->name,
		),*/
		'crDate',		
		array(
			'name'=>'Status',
			'value'=>$model->status0->status,
		),
	),
)); ?>
