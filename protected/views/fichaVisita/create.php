<?php
/* @var $this FichaVisitaController */
/* @var $model FichaVisita */

$this->breadcrumbs=array(
	'Autoevaluaciones'=>array('admin'),
	'Crear Autoevaluación',
);

$this->menu=array(
	array('label'=>'Ver registro de Autoevaluaciones', 'url'=>array('admin')),
);
?>

<h1>Crear Autoevaluación</h1>
<?php if(isset($_GET['nom'])){ ?>
 <div class="alert alert-success">
     <p>Empresa <b><?php echo $_GET['nom']; ?></b> guardada con exito.</p>
 </div>
<?php } ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>