<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Solicitud Contratos'=>array('admin'),
	$model->id,
);
if(Yii::app()->user->getState("tipo")==="administrador") {
$this->menu=array(
	
	array('label'=>'Crear Solicitud de Contrato', 'url'=>array('create')),
	array('label'=>'Editar Solicitud de Contrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Solicitud de Contrato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Solicitud de Contrato', 'url'=>array('admin')),
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

<h1>Ver Solicitud de Adhesión #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_ingreso',
		'fecha_cambio_estado',
		'rut_empresa',
                'empresa_relacionada',
		'nombre_empresa',
		'nombre_contacto_emp',
		'telefono_contacto_emp',
		'cantidad_trabajadores',
		'origen_emp',
                'codigo_actividad',
                'tipo_contrato',
		'nombre_ejecutivo',
                'nombre_sup',
                'nombre_jv',
		'usuario_web',
		'estado',
		'comentario',
                'vigencia',
                'fecha_solicitud',
                'cantidad_rechazada',
                'nro_memo',
                'mes_produccion',
                'comentario_fech_vali'
	),
)); ?>

<br>
<?php
    
    if(Yii::app()->user->getState("tipo")!== "supervisor"){
        
         //echo CHtml::button('Volver', array('submit' => array('solicitudContrato/admin', 'id'=>$model->id)));
          echo CHtml::button('Definir estado', array('submit' => array('solicitudContrato/update_estado', 'id'=>$model->id)));
     ?>
<?php

$ver = new Senaleticas();
if($ver->existenciaDeEntrega($model->rut_empresa)){ ?>
        <button class="btn btn-danger btn-lg" style="padding: 6.5px; margin-left: 80px;">
             Señaleticas ya entregadas
        </button>
<?php
    
}else{
if($model->estado == "Completa" || $model->estado == "Completa OPC"){
  ?>   
        <button class="btn btn-primary btn-lg" style="padding: 6.5px; margin-left: 80px;" data-toggle="modal" data-target="#senaleticas">
             Entregar señaleticas
        </button>
     <?php
}
    }
    }
    if(Yii::app()->user->getState("tipo")=== "supervisor" && $model->estado==="Rechazada"){
        
       echo CHtml::button('Reenviar solicitud de contrato ', array('submit' => array('solicitudContrato/update_estadoUno', 'id'=>$model->id),'confirm'=>'Para reenviar la solicitud de contrato, debe haber solucionado todos los motivos por el cual fue rechazado. ¿ Esta seguro de reenviar la solicitud de contrato?', 'name'=>'accept'));  
    }
    ?>





<div id="senaleticas" class="modal hide fade">
    <script>
$("document").ready(function () {
    
    $("#senaletica-form").submit(function() {
        var jve = $('#SolicitudContrato_rut_jv').val().trim();
        var sup = $('#SolicitudContrato_rut_sup').val().trim();
        var eje = $('#SolicitudContrato_rut_ejecutivo').val().trim();
        
    if (jve === ''|| jve===null || sup === '' || sup===null || eje === '' || eje === null) {
            alert('Debes seleccionar todos los campos');
            return false;
        }else{
            return true;
        }
  });
        
});
        
    </script>    
    
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>    
        <h4 class="modal-title">Entrega de Señaleticas</h4>
    </div>
    <div class="modal-body"> 
     <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'senaletica-form',
        'action'=>Yii::app()->createUrl("senaleticas/create"),
        'method'=>'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'validateOnType'=>true,
            
        )

)); ?>
    
   <?php // echo $form->errorSummary($model); 
   
  
   ?>
 
        <?php echo $form->hiddenField($model, 'id'); ?>
        <?php echo $form->hiddenField($model, 'rut_empresa'); ?>
        <?php echo $form->hiddenField($model, 'nombre_empresa'); ?>
        
       
	<div class="row">
		<?php echo $form->labelEx($model2,'Jefe de venta'); ?>
		<?php echo $form->dropDownList($model2,'rut_jv',array('14198477-2'=>'Emmanuel Segura'
                                                                ,'8820971-0'=>'Francisco Diaz'
                                                                ,'16666225-7'=>'Adolfo Gómez'),  array(
                            'ajax'=>array(
                              'type'=>'POST',
                              'url'=>CController::createUrl('SolicitudContrato/supervisorPorJV'),
                              'update'=>'#'.CHtml::activeId($model2,'rut_sup'),
                              'beforeSend' => 'function(){
                               $("#SolicitudContrato_rut_sup").find("option").remove();
                               $("#SolicitudContrato_rut_ejecutivo").find("option").remove();
                               }',  
                            ),'prompt'=>'Seleccione jefe de venta'
                            
                            
                        ));?>   
		<?php echo $form->error($model2,'rut_jv'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model2,'Supervisor'); ?>
	<?php 
                $lista_dos = array();
                if(isset($model2->rut_sup)){
                $rut_jv = $model2->rut_jv; 
                $lista_dos = $model2->getSup($rut_jv);
                }                
                echo $form->dropDownList($model2,'rut_sup',$lista_dos,
                        array(
                            'ajax'=>array(
                              'type'=>'POST',
                              'url'=>CController::createUrl('SolicitudContrato/ejecutivoPorSup'),
                              'update'=>'#'.CHtml::activeId($model2,'rut_ejecutivo'),
                              'beforeSend' => 'function(){
                              $("#SolicitudContrato_rut_ejecutivo").find("option").remove();
                               }',   
                                
                            ),
                            
                            'prompt'=>'Seleccione supervisor')
                        ); ?>
		<?php echo $form->error($model2,'rut_sup'); ?>
	</div>
        
        
        <div class="row">
		<?php echo $form->labelEx($model2,'Ejecutivo'); ?>
                    <?php 
                $rut_sup="";    
                $lista_tres = array();
                if(isset($model2->rut_ejecutivo)){
                $rut_sup = $model2->rut_sup; 
                $lista_tres = $model2->getEjecu($rut_sup);
                }
                echo $form->dropDownList($model2,'rut_ejecutivo',$lista_tres,
                        array('prompt'=>'Seleccione ejecutivo')
                        ); ?>
            
		<?php echo $form->error($model2,'rut_ejecutivo'); ?>
            <div id="rutEje" class="row" style="color: black; font-size: 16px; font-weight: bold; padding: 5px;">
                
            </div>
	</div>   
  
       
      
    </div>
    <div class="modal-footer">
         <a href="#" class="btn" data-dismiss="modal">Salir</a>
         <?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar Autoevaluación' : 'Aceptar',array('class'=>"btn btn-primary",'id'=>'agregarAutoev')); ?>
    </div> 
</div> 

    <?php $this->endWidget(); ?>  