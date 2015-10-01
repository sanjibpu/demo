<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enKey'); ?>
		<?php echo $form->textField($model,'enKey',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'typeId'); ?>
		<?php echo $form->textField($model,'typeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ipAddress'); ?>
		<?php echo $form->textField($model,'ipAddress',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'loginCount'); ?>
		<?php echo $form->textField($model,'loginCount',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'crBy'); ?>
		<?php echo $form->textField($model,'crBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'crDate'); ?>
		<?php echo $form->textField($model,'crDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->