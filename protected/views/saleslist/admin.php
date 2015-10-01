<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */

$this->breadcrumbs=array(
	'Saleslists'=>array('admin'),
	'Manage',
);

$this->menu=array(	
	array('label'=>'Create Saleslist', 'url'=>array('create')),
	array('label'=>'Manage Saleslist', 'url'=>array('admin')),
	array('label'=>'Import CSV', 'url'=>array('csvImport')),
);
?>

<h1>Manage Saleslists</h1>

<div class="search-form" style="display:none">

</div><!-- search-form -->

<?php 
Yii::app()->clientScript->registerScript('re-install-date-picker', "function reinstallDatePicker(id, data)
     {
       $('#date').datepicker({'dateFormat':'yy-mm-dd'});
       $('#dateSecond').datepicker({'dateFormat':'yy-mm-dd'});
     
     }");
 $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'saleslist-grid',
	'dataProvider'=>$model->search(),	
	'filter'=>$model,
	 'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		array('header' => 'Sl.',
                  'value' => '$row+1',
              ),
		'customerName',
		'productName',		
		array(
			'name'=>'date',
            'type'=>'raw',
            'value'=>'$data->date',
            'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker',array('model' =>$model,'attribute' =>'date','htmlOptions' =>array('id' =>'date'),'options' =>array('dateFormat'=>'yy-mm-dd')),true)
         ),
		array(
			'name'=>'date',
            'type'=>'raw',
            'value'=>'$data->date',
            'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker',array('model' =>$model,'attribute' =>'dateSecond','htmlOptions' =>array('id' =>'dateSecond'),'options' =>array('dateFormat'=>'yy-mm-dd')),true)
         ),
		/*array(
			'name'=>'crBy',
			'value'=>'$data->crBy0->username',
			'filter'=> Users::getAllActiveUser(Users::STATUS_ACTIVE),
			),	*/	
		//'crDate',
		array('name' => 'status',
            'value' => 'Lookup::getStatus($data->status)',
            'filter' => CHtml::activeDropDownList($model, 'status', UsefullFunction::typeStatus('Lookup', 'status'), array('empty' => 'All')),
        ),
		array(
	'class'=>'CButtonColumn',
		//template details
	'template'=>'{view}{update}{delete}',	
	//button details
	'buttons'=>array(),
	//delete details
	//'afterDelete'=>'function(link,success,data){alert("success");}',
	//'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/image/delete.png',
	'deleteButtonLabel'=>'Delete',
	'deleteButtonOptions'=>array('style'=>'width:50px;','class'=>'delete_class','id'=>'delete_id',),
	'deleteConfirmation'=>'Are you sure?',            
	//update details
	//'updateButtonImageUrl'=>Yii::app()->baseUrl.'/image/update.png',
	'updateButtonLabel'=>'Update',
	'updateButtonOptions'=>array('style'=>'width:50px;','class'=>'update_class','id'=>'update_id',),
	//view  details                                    
	//'viewButtonImageUrl'=>Yii::app()->baseUrl.'/image/view.png',
	'viewButtonLabel'=>'View',
	'viewButtonOptions'=>array('style'=>'width:50px;','class'=>'view_class','id'=>'view_id',),
	'visible'=>true,//or false

	//header details                             
	'header'=>'String Header',
	'headerHtmlOptions'=>array('style'=>'color:red;',),
	'header'=>CHtml::dropDownList('pageSize',$pageSize,array(5=>5,10=>10,20=>20,30=>30),array(
				  'onchange'=>"$.fn.yiiGridView.update('saleslist-grid',{ data:{pageSize: $(this).val() }})",
		)),
)
	),
)); 
/*
 array(
	'class'=>'CButtonColumn',
	//template details
	'template'=>'{view}{update}{delete}',
	//button details
	'buttons'=>array(),
	//delete details
	//'afterDelete'=>'function(link,success,data){alert("success");}',
	'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/image/delete.png',
	'deleteButtonLabel'=>'Delete',
	'deleteButtonOptions'=>array('style'=>'width:50px;','class'=>'delete_class','id'=>'delete_id',),
	'deleteConfirmation'=>'Are you sure?',            
	//update details
	'updateButtonImageUrl'=>Yii::app()->baseUrl.'/image/update.png',
	'updateButtonLabel'=>'Update',
	'updateButtonOptions'=>array('style'=>'width:50px;','class'=>'update_class','id'=>'update_id',),
	//view  details                                    
	'viewButtonImageUrl'=>Yii::app()->baseUrl.'/image/view.png',
	'viewButtonLabel'=>'View',
	'viewButtonOptions'=>array('style'=>'width:50px;','class'=>'view_class','id'=>'view_id',),
	'visible'=>true,//or false

	//header details                             
	'header'=>'String Header',
	'headerHtmlOptions'=>array('style'=>'color:red;',),
	'header'=>CHtml::dropDownList('pageSize',$pageSize,array(5=>5,10=>10,20=>20,30=>30),array(
				  'onchange'=>"$.fn.yiiGridView.update('branch-grid',{ data:{pageSize: $(this).val() }})",
		)),
)

*/



?>



