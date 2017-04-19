<?php
/* @var $this SegurosController */
/* @var $data Seguros */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->rut_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_ejecutivo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_certificado')); ?>:</b>
	<?php echo CHtml::encode($data->numero_certificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_vigencia')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_vigencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut')); ?>:</b>
	<?php echo CHtml::encode($data->rut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digito')); ?>:</b>
	<?php echo CHtml::encode($data->digito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_nacimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sexo')); ?>:</b>
	<?php echo CHtml::encode($data->sexo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comuna')); ?>:</b>
	<?php echo CHtml::encode($data->comuna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fono_particular')); ?>:</b>
	<?php echo CHtml::encode($data->fono_particular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('celular')); ?>:</b>
	<?php echo CHtml::encode($data->celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto')); ?>:</b>
	<?php echo CHtml::encode($data->producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan')); ?>:</b>
	<?php echo CHtml::encode($data->plan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('odonto_individual')); ?>:</b>
	<?php echo CHtml::encode($data->odonto_individual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('odonto_familiar')); ?>:</b>
	<?php echo CHtml::encode($data->odonto_familiar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('renta_mensual')); ?>:</b>
	<?php echo CHtml::encode($data->renta_mensual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interven_quirurgicas')); ?>:</b>
	<?php echo CHtml::encode($data->interven_quirurgicas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prima_mensual_uf')); ?>:</b>
	<?php echo CHtml::encode($data->prima_mensual_uf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inicio_cobranza')); ?>:</b>
	<?php echo CHtml::encode($data->inicio_cobranza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('via_pago')); ?>:</b>
	<?php echo CHtml::encode($data->via_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banco')); ?>:</b>
	<?php echo CHtml::encode($data->banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_banco')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_cta_corriente')); ?>:</b>
	<?php echo CHtml::encode($data->num_cta_corriente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_tarjeta')); ?>:</b>
	<?php echo CHtml::encode($data->num_tarjeta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_sucursal')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_sucursal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->rut_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('digito_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->digito_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacto_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->contacto_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->direccion_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_empresa')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_empresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	*/ ?>

</div>