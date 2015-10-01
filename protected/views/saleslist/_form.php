<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */
/* @var $form CActiveForm */
?>

<?php
/* @var $this SaleslistController */
/* @var $model Saleslist */

$this->breadcrumbs=array(
    'Saleslists'=>array('admin'),
    'Create',
);

$this->menu=array(  
    array('label'=>'Create Saleslist', 'url'=>array('create')),
    array('label'=>'Manage Saleslist', 'url'=>array('admin')),
    array('label'=>'Import CSV', 'url'=>array('csvImport')),
);
?>
<h1><?php echo ($model->isNewRecord) ? 'Add' : 'Update' ?> Saleslist</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'saleslist-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => 'branch-form',
            'enctype' => 'multipart/form-data',
            'role' => 'form',
        ),
)); ?>

	<?php  

        if(!empty($msg)) echo $msg;
        else echo  "<div class='alert alert-warning  fade in'><i data-dismiss='alert' class='icon-remove close'></i>All <span class='required'>*</span> fields are required</div>";
    ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customerName'); ?>
		<?php echo $form->textField($model,'customerName',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'customerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'productName'); ?>
		<?php echo $form->textField($model,'productName',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'productName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>		
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'date',
                            'language' => 'en',
                            //'themeUrl' => Yii::app()->baseUrl . '/css/jui',
                            //'theme' => 'softark',
                            //'cssFile' => 'jquery-ui-1.9.2.custom.css',
                            'options' => array(
                                // 'showOn' => 'both',             // also opens with a button
                                'dateFormat' => 'yy-mm-dd', // format of "2012-12-25"
                                'showOtherMonths' => true, // show dates in other months
                                'selectOtherMonths' => true, // can seelect dates in other months
                                'changeYear' => true, // can change year
                                'changeMonth' => true, // can change month
                                'yearRange' => '2000:2099', // range of year
                                'minDate' => '2000-01-01', // minimum date
                                'maxDate' => '2099-12-31', // maximum date
                            //'showButtonPanel' => true,      // show button panel
                            ),
                            'htmlOptions' => array(
                                'size' => '10',
                                'maxlength' => '10',
                                'class' => 'form-control',
                            ),
                        ));
                        ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	

	 <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', UsefullFunction::typeStatus('Lookup', 'status'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->