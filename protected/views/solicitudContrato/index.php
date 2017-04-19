<?php
/* @var $this SolicitudContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solicitud Contratos',
);

$this->menu=array(
	array('label'=>'Create SolicitudContrato', 'url'=>array('create')),
	array('label'=>'Manage SolicitudContrato', 'url'=>array('admin')),
);
?>

<h1>Solicitud Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
