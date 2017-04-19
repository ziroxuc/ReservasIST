<?php
/* @var $this SolicitudContratoController */
/* @var $data SolicitudContrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_cambio_estado')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_cambio_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->rut_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_contacto_emp')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_contacto_emp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_contacto_emp')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_contacto_emp); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_trabajadores')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_trabajadores); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_solicitud')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_solicitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origen_emp')); ?>:</b>
	<?php echo CHtml::encode($data->origen_emp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->rut_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_solicitante')); ?>:</b>
	<?php echo CHtml::encode($data->rut_solicitante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_rechazada')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_rechazada); ?>
	<br />

	*/ ?>

</div>