<?php
/* @var $this RegistroContratosController */
/* @var $model RegistroContratos */

$this->breadcrumbs=array(
	'Registro de Contratos'=>array('index'),
	'Registros',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#registro-contratos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Registros de solicitudes de contratos</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'registro-contratos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'rut_empresa',
		'nombre_empresa',
		'rut_usuario',
                'tipo_solicitud',
		'fecha',
		'estado',
                'comentario_fech_vali',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}',
		),
	),
)); ?>
