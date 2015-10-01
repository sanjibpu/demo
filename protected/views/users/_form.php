<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Create',
);

$this->menu=array(	
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1><?php echo ($model->isNewRecord) ? 'Add' : 'Update' ?> User</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
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
		else echo  "<div class='alert alert-warning  fade in'><i data-dismiss='alert' class='icon-remove close'></i>Please Select Employee Type, Employee Group and Month.</div>";
	?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150,'readonly'=>($model->scenario == 'update')? true : false)); ?>
      
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	 <div class="row">
        <?php echo $form->labelEx($model, 'typeId'); ?>
        <?php echo $form->dropDownList($model, 'typeId', UsefullFunction::typeStatus('Lookup', 'userType'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'typeId'); ?>
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