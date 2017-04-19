<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Solicitud de Adhesión'=>array('admin'),
	'Administrar',
);
if(Yii::app()->user->getState("tipo")==="administrador") {
$this->menu=array(
	array('label'=>'Crear Solicitud de adhesión', 'url'=>array('create')),
        array('label'=>'Crear documento Memo', 'url'=>array('#Memo'),'linkOptions'=>array('data-toggle'=>'modal'),),
        array('label'=>'Descargar reporte general', 'url'=>array('#reporteGeneral'),'linkOptions'=>array('data-toggle'=>'modal'),),
        //array('label'=>'Buscar Empresa o Ejecutivo', 'url'=>array('#busqueda'),'linkOptions'=>array('data-toggle'=>'modal'),),
        array('label'=>'Buscar producción', 'url'=>array('#busqueda'),'linkOptions'=>array('data-toggle'=>'modal'),),

        );
}elseif(Yii::app()->user->getState("tipo")==="jefe de venta"||Yii::app()->user->getState("tipo")==="supervisor"){
   $this->menu=array(
	array('label'=>'Descargar reporte general', 'url'=>array('#reporteGeneral'),'linkOptions'=>array('data-toggle'=>'modal'),),
); 
}else{
    $this->menu=array(
	array('label'=>'.'),
    );  
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#solicitud-contrato-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Solicitud de adhesión
 <?php  
  if(Yii::app()->user->getState("tipo")==="administrador"){
    
   //echo CHtml::button('Descargar reporte Mensual', array('submit' => array('solicitudContrato/selecReportes'),'style'=>'float:right;')); 
  echo CHtml::button('Reporte cantidad', array('submit' => array('solicitudContrato/reporteNumerosEjecutivos'),'style'=>'float:right;')); 
  
   
   
  } 
   
  
 //echo CHtml::button('Title', array('onclick' => 'js:document.location.href="#reporteGeneral"'));
 //echo CHtml::button('Descargar Datos Excel', array('submit' => array('#reporteGeneral'),'style'=>'float:right;',''));
 
?></h1>
<?php 
//'rowCssClassExpression'=>'($data->estado=="No aceptada")?"rechazada":(($data->estado=="Ingresada")?"ingresada":"aprobada")',
if(Yii::app()->user->getState("tipo")==="administrador") {
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'solicitud-contrato-grid',
	'dataProvider'=>$model->search(),
       'rowCssClassExpression'=>'($data->estado=="Devuelta")?"rechazada":(($data->estado=="En revision")?"ingresada":"aprobada")',

	'filter'=>$model,
	'columns'=>array(
		
                'nombre_jv',
                'nombre_sup',
                'nombre_ejecutivo',
                'nombre_empresa',
                'rut_empresa',
                'fecha_cambio_estado',
                'estado',
                'origen_emp',
                'tipo_contrato',
                'vigencia',
                'fecha_solicitud',
                'nro_memo',
                //'comentario',
                
		/*
		'telefono_contacto_emp',
		'cantidad_trabajadores',
		'fecha_solicitud',
		'origen_emp',
		
		'rut_ejecutivo',
		'rut_solicitante',
		'cantidad_rechazada',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
}else{
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'solicitud-contrato-grid',
	'dataProvider'=>$model->search(),
       'rowCssClassExpression'=>'($data->estado=="Incompleta")?"rechazada":(($data->estado=="Ingresada")?"ingresada":"aprobada")',

	'filter'=>$model,
	'columns'=>array(
		
                'nombre_ejecutivo',
                'nombre_empresa',
                'rut_empresa',
		'fecha_ingreso',
                'fecha_cambio_estado',
		'nombre_contacto_emp',
                'estado',
                'origen_emp',
                'vigencia',
                'fecha_solicitud',
                'comentario',
		/*
		'telefono_contacto_emp',
		'cantidad_trabajadores',
		'fecha_solicitud',
		'origen_emp',
		
		'rut_ejecutivo',
		'rut_solicitante',
		'cantidad_rechazada',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}',
		),
	),
));    
}
?>
<script type="text/javascript">
        $(document).ready(function() {
            $("#buscar_error").hide();
            $('#buscar_error_rut').hide();
          
            var op=true;
            
              $('#Buscar_rut').Rut({
                    on_error: function(){ 
                        op=false;
                        $('#buscar_error_rut').show();
                      },
                    on_success: function(){ 
                          op=true; 
                          $('#buscar_error_rut').hide();
                      },
                    format_on: 'keyup' 
                    //format: false
                  });
            
            
            
        $("#salir").click(function() {
         $("#fechas-modal-form")[0].reset();
         });
         $("#cerrar").click(function() {
         $("#fechas-modal-form")[0].reset();
         }); 
         
         $("#solicitud-contrato-modal-form-buscar").submit(function(){
                    var rut=$("#Buscar_rut").val();
                    var tipo=$("Buscar_op").val();
                    if(rut.length<1 || tipo.length<1 || op===false){
                        $("#buscar_error").show();
                        return false;
                    }else{
                        $("#buscar_error").hide();
                        $('#buscar_error_rut').hide();
                        return true;
                    } 
            });
        });
        
        
        
</script>

<div id="Memo" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>    
        <h4 class="modal-title">Crear Memo</h4>
    </div>
    <div class="modal-body">
       
    <div class="row">
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'crearMemo',
            'method'=>'post',
             'id'=>'solicitud-contrato-modal-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
             'validateOnSubmit'=>true,
             )
     )); ?>  

     <?php echo $form->labelEx($memo,'numero_memo'); ?>
     <?php echo $form->dropDownList($memo,'numero_memo',$memo->getNro_memo(),array('empty'=>'Seleccione...')); ?>
     <?php echo $form->error($memo,'numero_memo'); ?>
    
    </div>
      
    </div>
    <div class="modal-footer">
         <a href="#" class="btn" data-dismiss="modal">Salir</a>
         
         <?php echo CHtml::submitButton('Crear',array('class'=>"btn btn-primary")); ?>
    </div> 
    <?php $this->endWidget(); ?>
</div>   

<div id="reporteGeneral" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="cerrar">X</button>    
        <h4 class="modal-title">Descarga de reporte general</h4>
    </div>
    <div class="modal-body">
       
    
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'index',
            'method'=>'post',
             'id'=>'fechas-modal-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             )
     )); ?> 
        <div class="alert alert-info"><b>Si no selecciona un rango de fechas, se descargará toda la información</b></div>   
    <div class="row">
     <?php echo $form->labelEx($modelfecha,'fecha_inicio'); ?>
     <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$modelfecha,
                        'attribute'=>'fecha_inicio',
                        'value'=>$modelfecha->fecha_inicio,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$modelfecha->fecha_inicio,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_inicio',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        //'minDate'=>'-3M', //fecha minima
                        //'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
     <?php echo $form->error($modelfecha,'fecha_inicio'); ?>
    
    </div>
    <div class="row">
     <?php echo $form->labelEx($modelfecha,'fecha_fin'); ?>
     <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$modelfecha,
                        'attribute'=>'fecha_fin',
                        'value'=>$modelfecha->fecha_fin,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$modelfecha->fecha_fin,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_fin',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        //'minDate'=>'-3M', //fecha minima
                        //'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
     <?php echo $form->error($modelfecha,'fecha_fin'); ?>
    
    </div>
      
    </div>
    
    <div class="modal-footer">
         <a href="#" class="btn" data-dismiss="modal" id="salir">Salir</a>
         
         <?php echo CHtml::submitButton('Descargar',array('class'=>"btn btn-primary",'id'=>'sbtFecha')); ?>
    </div> 
    <?php $this->endWidget(); ?>
</div>  



<div id="busqueda" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>    
        <h4 class="modal-title">Buscar producción</h4>
    </div>
    <div class="modal-body">
       
        
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'buscar',
            'method'=>'post',
             'id'=>'solicitud-contrato-modal-form-buscar',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             )
     )); ?> 
        <div class="alert alert-danger" id="buscar_error"><b>Debe completar todos los campos</b></div>
        <div class="alert alert-danger" id="buscar_error_rut"><b>Debe ingresar un rut valido</b></div> 
        
     <div class="row"> 
        <?php echo $form->labelEx($buscar,'rut'); ?>
        <?php echo $form->textField($buscar,'rut',array('size'=>15,'maxlength'=>15)); ?>
        <?php echo $form->error($buscar,'rut'); ?>
     </div>
     <div class="row"> 
        <?php echo $form->labelEx($buscar,'op'); ?> 
        <?php echo $form->dropDownList($buscar,'op',array('1'=>'Jefe de venta'
                                                                  ,'2'=>'Supervisor'
                                                                  ,'3'=>'Ejecutivo'),array('empty'=>'Seleccione el tipo')); ?>
        <?php echo $form->error($buscar,'op'); ?>
     </div>
        
    </div>    
    <div class="modal-footer">
         <a href="#" class="btn" data-dismiss="modal">Salir</a>
         
         <?php echo CHtml::submitButton('Buscar',array('class'=>"btn btn-primary")); ?>
    </div> 
    <?php $this->endWidget(); ?>
</div> 




