<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */
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
		<?php echo $form->label($model,'fecha_ingreso'); ?>
		<?php echo $form->textField($model,'fecha_ingreso',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_cambio_estado'); ?>
		<?php echo $form->textField($model,'fecha_cambio_estado',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_contacto_emp'); ?>
		<?php echo $form->textField($model,'nombre_contacto_emp',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono_contacto_emp'); ?>
		<?php echo $form->textField($model,'telefono_contacto_emp',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_trabajadores'); ?>
		<?php echo $form->textField($model,'cantidad_trabajadores'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_solicitud'); ?>
		<?php echo $form->textField($model,'fecha_solicitud',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origen_emp'); ?>
		<?php echo $form->textField($model,'origen_emp',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_ejecutivo'); ?>
		<?php echo $form->textField($model,'nombre_ejecutivo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_ejecutivo'); ?>
		<?php echo $form->textField($model,'rut_ejecutivo',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_solicitante'); ?>
		<?php echo $form->textField($model,'rut_solicitante',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_rechazada'); ?>
		<?php echo $form->textField($model,'cantidad_rechazada'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->