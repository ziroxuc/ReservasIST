<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Crear usuarios',
);

$this->menu=array(
	
	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
       
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>