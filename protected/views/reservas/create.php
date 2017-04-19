<?php
/* @var $this ReservasController */
/* @var $model Reservas */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	'Crear Reservas',
);

$this->menu=array(
	
	array('label'=>'Adminstrar Reservas', 'url'=>array('admin')),
);
?>

<h1>Crear Reservas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>