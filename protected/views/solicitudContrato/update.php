<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Solicitud Adhesión'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(

	array('label'=>'Crear Solicitud de Adhesión', 'url'=>array('create')),
	array('label'=>'Ver Solicitud de Adhesión', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Solicitud de Adhesión', 'url'=>array('admin')),
);
?>

<h1>Editar Solicitud de Adhesión <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>