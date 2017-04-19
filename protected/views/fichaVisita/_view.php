<?php
/* @var $this FichaVisitaController */
/* @var $data FichaVisita */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_jv')); ?>:</b>
	<?php echo CHtml::encode($data->rut_jv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_jv')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_jv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_sup')); ?>:</b>
	<?php echo CHtml::encode($data->rut_sup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_sup')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_sup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_eje')); ?>:</b>
	<?php echo CHtml::encode($data->rut_eje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_eje')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_eje); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->rut_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->direccion_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comuna_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->comuna_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fono_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->fono_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_visita')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_web')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_web); ?>
	<br />

	*/ ?>

</div>