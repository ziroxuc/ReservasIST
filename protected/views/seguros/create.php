<?php
/* @var $this SegurosController */
/* @var $model Seguros */

$this->breadcrumbs=array(
	'Seguros'=>array('index'),
	'Crear',
);

$this->menu=array(

	array('label'=>'Administrar Seguros', 'url'=>array('admin')),
);
?>

<h1>Crear Seguros</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>