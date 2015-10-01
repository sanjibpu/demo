<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enKey')); ?>:</b>
	<?php echo CHtml::encode($data->enKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typeId')); ?>:</b>
	<?php echo CHtml::encode($data->typeId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ipAddress')); ?>:</b>
	<?php echo CHtml::encode($data->ipAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loginCount')); ?>:</b>
	<?php echo CHtml::encode($data->loginCount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crBy')); ?>:</b>
	<?php echo CHtml::encode($data->crBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crDate')); ?>:</b>
	<?php echo CHtml::encode($data->crDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>