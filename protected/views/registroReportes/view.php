<?php
/* @var $this RegistroReportesController */
/* @var $model RegistroReportes */

$this->breadcrumbs=array(
	'Registro Reportes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RegistroReportes', 'url'=>array('index')),
	array('label'=>'Create RegistroReportes', 'url'=>array('create')),
	array('label'=>'Update RegistroReportes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RegistroReportes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RegistroReportes', 'url'=>array('admin')),
);
?>

<h1>View RegistroReportes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre_usuario',
		'rut_usuario',
		'tipo_usuario',
		'fecha_conexion',
		'cantidad_conexiones',
		'tipo_reporte',
	),
)); ?>
