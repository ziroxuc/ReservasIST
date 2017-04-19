<?php
/* @var $this SegurosController */
/* @var $model Seguros */

$this->breadcrumbs=array(
	'Seguros'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(

        array('label'=>'Crear Seguros', 'url'=>array('create')),
        array('label'=>'Crear Seguros derivados', 'url'=>array('createDerivado')),
	array('label'=>'Ver Seguros', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Seguros', 'url'=>array('admin')),
);
?>

<h1>Actualizar Seguros <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>