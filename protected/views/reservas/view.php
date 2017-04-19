<?php
/* @var $this ReservasController */
/* @var $model Reservas */

$this->breadcrumbs=array(
	'Reservas'=>array('admin'),
	$model->id,
);
if(Yii::app()->user->getState("tipo")==="Operaciones comerciales"){
$this->menu=array(
	
	array('label'=>'Crear Reservas', 'url'=>array('create')),
	array('label'=>'Reasignar Reservas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Reservas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Reservas', 'url'=>array('admin')),
);
}else{
   $this->menu=array(
	
	array('label'=>'Crear Reservas', 'url'=>array('create')),
	
	array('label'=>'Administrar Reservas', 'url'=>array('admin')),
); 
    
}
?>

<h1>Ver Reservas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rut_empresa',
		'nombre_empresa',
		'rut_ejecutivo',
		'nombre_ejecutivo',
		'fecha_inicio',
		'hora_reserva',
		'fecha_termino',
		'estado',
		'tipo_reserva',
	),
)); ?>
</br>
<?php
    
    if(Yii::app()->user->getState("tipo")!== "ist"){
 
        echo CHtml::button('Aceptar Reserva', array('submit' => array('reservas/aceptarReserva', 'id'=>$model->id),'confirm'=>'¿Desea reservar esta empresa?', 'name'=>'accept'));  
        echo CHtml::button('Rechazar Reserva', array('submit' => array('reservas/rechazarReserva', 'id'=>$model->id))); 
    }
    ?>
