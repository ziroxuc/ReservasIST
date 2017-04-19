<?php
/* @var $this SegurosController */
/* @var $model Seguros */

$this->breadcrumbs=array(
	'Seguroses'=>array('index'),
	$model->id,
);

$this->menu=array(
        
        array('label'=>'Crear Seguros', 'url'=>array('create')),
        array('label'=>'Crear Seguros derivados', 'url'=>array('createDerivado')),
	array('label'=>'Actualizar Seguro', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Seguro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Seguros', 'url'=>array('admin')),
);
?>

<h1>Ver Seguro #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'rut_jv',
		'nombre_jv',
		'rut_sup',
		'nombre_sup',
		'rut_ejecutivo',
		'nombre_ejecutivo',
		'numero_certificado',
		'fecha_vigencia',
		'fecha_ingreso',
		'nombre',
		'rut',
		'digito',
		'fecha_nacimiento',
		'sexo',
		'direccion',
		'comuna',
		'region',
		'fono_particular',
		'celular',
		'email',
		'producto',
		'plan',
		'odonto_individual',
		'odonto_familiar',
		'renta_mensual',
		'interven_quirurgicas',
		'prima_mensual_uf',
		'inicio_cobranza',
		'via_pago',
		'banco',
		'nombre_banco',
		'num_cta_corriente',
		'num_tarjeta',
		'codigo_sucursal',
		'rut_empresa',
		'digito_empresa',
		'nombre_empresa',
		'contacto_empresa',
		'direccion_empresa',
		'telefono_empresa',
		'estado',
	),
)); ?>
