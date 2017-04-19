<?php
/* @var $this FichaVisitaController */
/* @var $model FichaVisita */

$this->breadcrumbs=array(
	'Autoevaluaciones'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Editar Autoevaluación',
);
  if(Yii::app()->user->getState('tipo')=="supervisor"){
$this->menu=array(
       
	array('label'=>'Crear nueva Autoevaluación', 'url'=>array('create')),
	array('label'=>'Ver registro de Autoevaluaciones', 'url'=>array('admin')),);
  }else{
   $this->menu=array(
	array('label'=>'Ver registro de Autoevaluaciones', 'url'=>array('admin')),);
   
  }
?>
 <h1>Editar Autoevaluación <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

