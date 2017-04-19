<?php
/* @var $this RegistroReportesController */
/* @var $model RegistroReportes */

$this->breadcrumbs=array(
	'Registro Reportes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RegistroReportes', 'url'=>array('index')),
	array('label'=>'Manage RegistroReportes', 'url'=>array('admin')),
);
?>

<h1>Create RegistroReportes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>