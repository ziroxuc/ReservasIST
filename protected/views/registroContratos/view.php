<?php
/* @var $this RegistroContratosController */
/* @var $model RegistroContratos */

$this->breadcrumbs=array(
	'Registro Contratoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RegistroContratos', 'url'=>array('index')),
	array('label'=>'Create RegistroContratos', 'url'=>array('create')),
	array('label'=>'Update RegistroContratos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RegistroContratos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RegistroContratos', 'url'=>array('admin')),
);
?>

<h1>View RegistroContratos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rut_empresa',
		'nombre_empresa',
		'rut_usuario',
		'fecha',
		'estado',
                'comentario_fech_vali'
	),
)); ?>
