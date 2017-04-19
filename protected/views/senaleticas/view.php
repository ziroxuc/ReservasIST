<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Señaleticas'=>array('admin'),
	$model->rut_empresa,
);

$this->menu=array(
	
	array('label'=>'Administrar Señaleticas', 'url'=>array('admin')),
    array('label'=>'Completar o editar datos', 'url'=>array('viewAgregarDatos', 'id'=>$model->id)),

    

);

 
?>

<h1>Ver Señaletica para rut empresa : #<?php echo $model->rut_empresa; ?></h1>
<?php if(isset($_POST['senaleticaOK'])){ ?>
<div class="alert alert-success"><b>¡Se realizo la solicitud de señaleticas correctamente!</b></div>
<?php } ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
			'id',
			'usuario_web',
			'rut_jv',
			'nombre_jv',
			'rut_sup',
			'nombre_sup' ,
			'rut_eje',
			'nombre_eje',
			'nombre_empresa',
			'rut_empresa',
			'fecha_entrega',
			'estado',
			'nombre_recibe',
			'cargo',
			'telefono',
			'fecha_recepcion',
			'nombre_pago',
			'telefono_pago',
	),
)); ?>

