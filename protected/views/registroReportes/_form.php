<?php
/* @var $this RegistroReportesController */
/* @var $model RegistroReportes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registro-reportes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_usuario'); ?>
		<?php echo $form->textField($model,'nombre_usuario',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'nombre_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rut_usuario'); ?>
		<?php echo $form->textField($model,'rut_usuario',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'rut_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_usuario'); ?>
		<?php echo $form->textField($model,'tipo_usuario',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tipo_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_conexion'); ?>
		<?php echo $form->textField($model,'fecha_conexion'); ?>
		<?php echo $form->error($model,'fecha_conexion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_conexiones'); ?>
		<?php echo $form->textField($model,'cantidad_conexiones'); ?>
		<?php echo $form->error($model,'cantidad_conexiones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_reporte'); ?>
		<?php echo $form->textField($model,'tipo_reporte',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'tipo_reporte'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->