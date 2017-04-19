<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Solicitud Adhesión'=>array('admin'),
	'Crear',
);

$this->menu=array(
	
	array('label'=>'Administrar Solicitud de Contrato', 'url'=>array('admin')),
);
?>

<h1>Crear Solicitud de Adhesión</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>