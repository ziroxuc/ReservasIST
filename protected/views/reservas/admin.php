<?php
/* @var $this ReservasController */
/* @var $model Reservas */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	'Administrar',
);
if(Yii::app()->user->getState("tipo")==="Operaciones comerciales"||Yii::app()->user->getState("tipo")==="administrador"){
  $this->menu=array(
	
	array('label'=>'Crear Reservas', 'url'=>array('create')),
        array('label'=>'Crear usuario externo', 'url'=>array('usuario/createExterno')),
);  
    
}else{
$this->menu=array(
	
	array('label'=>'Crear Reservas', 'url'=>array('create')),
        
);
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reservas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar reservas</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reservas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'rut_empresa',
		'nombre_empresa',
		'rut_ejecutivo',
		'nombre_ejecutivo',
		'fecha_inicio',
                'fecha_termino',
                'hora_reserva',
                'estado',
                'tipo_reserva',
	array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
