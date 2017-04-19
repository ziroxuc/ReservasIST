<?php
/* @var $this SegurosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguroses',
);

$this->menu=array(
	array('label'=>'Create Seguros', 'url'=>array('create')),
	array('label'=>'Manage Seguros', 'url'=>array('admin')),
);
?>

<h1>Seguroses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
