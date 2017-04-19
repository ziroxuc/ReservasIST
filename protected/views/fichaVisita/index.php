<?php
/* @var $this FichaVisitaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ficha Visitas',
);

$this->menu=array(
	array('label'=>'Create FichaVisita', 'url'=>array('create')),
	array('label'=>'Manage FichaVisita', 'url'=>array('admin')),
);
?>

<h1>Ficha Visitas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
