<?php
/* @var $this RegistroReportesController */
/* @var $model RegistroReportes */

$this->breadcrumbs=array(
	'Registro Reportes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RegistroReportes', 'url'=>array('index')),
	array('label'=>'Create RegistroReportes', 'url'=>array('create')),
	array('label'=>'View RegistroReportes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RegistroReportes', 'url'=>array('admin')),
);
?>

<h1>Update RegistroReportes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>