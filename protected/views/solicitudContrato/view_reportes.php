<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Solicitud Contratos'=>array('admin')
);
if(Yii::app()->user->getState("tipo")==="administrador") {
$this->menu=array(
	array('label'=>'Administrar Solicitud de Adhesión', 'url'=>array('admin')),
);
}else{
   $this->menu=array(
	
	//array('label'=>'Crear Solicitud de Contrato', 'url'=>array('create')),
	//array('label'=>'Editar Solicitud de Contrato', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Eliminar Solicitud de Contrato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Ver Solicitudes de Adhesión', 'url'=>array('admin')),
); 
}
?>

<h1>Reportes </h1>

<fieldset>
<legend>Reporte detallado mensual</legend>   
   <div class="form-group">
    <?php echo CHtml::link('Enero', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"01")); ?> | 
    <?php echo CHtml::link('Febrero', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"02")); ?> | 
    <?php echo CHtml::link('Marzo', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"03")); ?> | 
    <?php echo CHtml::link('Abril', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"04")); ?> | 
    <?php echo CHtml::link('Mayo', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"05")); ?> | 
    <?php echo CHtml::link('Junio', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"06")); ?> | 
    <?php echo CHtml::link('Julio', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"07")); ?> | 
    <?php echo CHtml::link('Agosto', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"08")); ?> | 
    <?php echo CHtml::link('Septiembre', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"09")); ?> | 
    <?php echo CHtml::link('Octubre', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"10")); ?> | 
    <?php echo CHtml::link('Noviembre', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"11")); ?> | 
    <?php echo CHtml::link('Diciembre', array('solicitudContrato/reporteDetalladoMensual', 'mes'=>"12")); ?>  
  </div>
</fieldset>









