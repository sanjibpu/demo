<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(	
	array('label'=>'Add User', 'url'=>array('create')),
);
?>

<h1>Manage Users</h1>
<div class="search-form" style="display:none">

</div><!-- search-form -->
<?php
    $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
	 $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'users-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
		array(
			'header'=>'SL.No',
			'value'=>'$row+1',
		),
		//	'id',
		'name',
		'username',
		//'password',
		//'enKey',
		'email',
		array('name' => 'status',
            'value' => 'Lookup::getStatus($data->status)',
            'filter' => CHtml::activeDropDownList($model, 'status', UsefullFunction::typeStatus('Lookup', 'status'), array('empty' => 'All')),
        ),
		/*
		'typeId',
		'ipAddress',
		'loginCount',
		'crBy',
		'crDate',
		'status',
		*/		
		array(
			'class'=>'CButtonColumn',
			'deleteConfirmation'=>"js:'Do you really want to delete record with ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(5=>5,10=>10,20=>20,30=>30),array(
					  'onchange'=>"$.fn.yiiGridView.update('users-grid',{ data:{pageSize: $(this).val() }})",
			)),
		 ),
		 
		 
	),
)); ?>