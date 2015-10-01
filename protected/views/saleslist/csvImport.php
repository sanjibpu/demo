<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */

$this->breadcrumbs=array(
	'Saleslists'=>array('admin'),
	'Import Csv',
);

$this->menu=array(  
    array('label'=>'Create Saleslist', 'url'=>array('create')),
    array('label'=>'Manage Saleslist', 'url'=>array('admin')),
    array('label'=>'Import CSV', 'url'=>array('csvImport')),
);
?>


<h1>Import CSV</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'import-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array(
            'class' => 'branch-form',
            'enctype' => 'multipart/form-data',
            'role' => 'form',
        ),
)); ?>
   <?php 	

		if(!empty($msg)) echo $msg;
		else echo  "<div class='alert alert-warning  fade in'><i data-dismiss='alert' class='icon-remove close'></i>Select a CSV file</div>";
	?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Upload'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->





