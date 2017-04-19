<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */

$this->breadcrumbs=array(
	'Solicitud Adhesión'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Validar',
);

$this->menu=array(

	array('label'=>'Crear Solicitud de Adhesión', 'url'=>array('create')),
	array('label'=>'Ver Solicitud de Adhesión', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Solicitud de Adhesión', 'url'=>array('admin')),
);
?>

<h1>Validar Solicitud de Adhesión <?php echo $model->id; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-contrato-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'validateOnType'=>true,
            
        )
)); ?>
    
      
    <?php //echo $form->errorSummary($model); ?>
       <fieldset>
        <legend>Ejecutivo:</legend>
    
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_ejecutivo'); ?>
		<?php echo $form->textField($model,'nombre_ejecutivo',array('size'=>45,'maxlength'=>45,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'nombre_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rut_ejecutivo'); ?>
		<?php echo $form->textField($model,'rut_ejecutivo',array('size'=>10,'maxlength'=>10,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'rut_ejecutivo'); ?>
	</div>
        
         </fieldset>
    
        <fieldset>
    <legend>Empresa:</legend>
        
	<div class="row">
		<?php echo $form->labelEx($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>12,'maxlength'=>10,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'rut_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>60,'maxlength'=>30,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'nombre_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_contacto_emp'); ?>
		<?php echo $form->textField($model,'nombre_contacto_emp',array('size'=>60,'maxlength'=>30,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'nombre_contacto_emp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_contacto_emp'); ?>
		<?php echo $form->textField($model,'telefono_contacto_emp',array('size'=>15,'maxlength'=>12,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'telefono_contacto_emp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_trabajadores'); ?>
		<?php echo $form->textField($model,'cantidad_trabajadores',array('size'=>15,'maxlength'=>3,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'cantidad_trabajadores'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'tipo_contrato'); ?>
		<?php echo $form->textField($model,'tipo_contrato',array('size'=>20,'maxlength'=>20,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'tipo_contrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origen_emp'); ?>
		<?php echo $form->dropDownList($model,'origen_emp',array('Ninguno'=>'Ninguno'
                                                                  ,'ISL'=>'ISL'
                                                                  ,'CCHC'=>'Mutual de Seguridad'
                                                                  ,'ACHS'=>'Asociación chilena de seguridad'),array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'origen_emp'); ?>
	</div>
    
        </fieldset>
    
         <fieldset>
        <legend>Respuesta:</legend>
        
  <script type="text/javascript">
      $(document).ready(function(){
            $('#SolicitudContrato_estado').change(function (){
                var opc=$('#SolicitudContrato_estado').val(); 
                if(opc=='Completa'){
                    $('#addComletas').show();
                }else if(opc=="Completa OPC"){
                    $('#addCompletaOPC').show();
                         $("#solicitud-contrato-form").submit(function () {  
                        if($("#SolicitudContrato_mes_produccion").val().length < 1) {  
                            alert("Debe ingresar mes de producción."); 
                            return false;
                        }      
                }); 
        
                }else{
                    $('#addCompletaOPC').hide();
                    $('#addComletas').hide();
                }
            });
         }); 
        </script> 
        
        
        <div class="row">
           <?php echo $form->labelEx($model,'estado'); ?>
	   <?php echo $form->dropDownList($model,'estado',array(
                                                            
                                                             'En revision'=>'En revision'
                                                            ,'Completa'=>'Completa'
                                                            ,'Devuelta'=>'Devuelta'
                                                            ,'Renuncia'=>'Renuncia'
                                                            ,'Rechazada'=>'Rechazada'
               
                                                            ,'En revision OPC'=>'En revision OPC'
                                                            ,'Completa OPC'=>'Completa OPC'
                                                            ,'Devuelta OPC'=>'Devuelta OPC'
                                                            ,'Pendiente'=>'Pendiente'
                                                            ,'Anulado'=>'Anulado'
                                                                )
                                                            
                                                            ,array('empty'=>'Seleccione un estado',
                                                                )
                   ); ?>
            <?php echo $form->error($model,'estado'); ?>
        </div>    
            
       <div class="row">
            <?php echo $form->labelEx($model,'comentario'); ?>
            <?php echo $form->textArea($model,'comentario',array('rows'=>12, 'cols'=>50,'class'=>'span10')); ?>
            <?php echo $form->error($model,'comentario'); ?>
        </div>
     <div id="addComletas" <?php echo $model->estado=='Completa' ?'style="display:block"' :'style="display:none"'?> >
        

        <div class="row">
		<?php echo $form->labelEx($model,'nro_memo'); ?>
		<?php echo $form->textField($model,'nro_memo',array('size'=>15,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'nro_memo'); ?>
	</div>
       
     </div> 
        <div class="row" id="addCompletaOPC" <?php echo $model->estado=='Completa OPC' ?'style="display:block"' :'style="display:none"'?>>
           
		<?php echo $form->labelEx($model,'mes_produccion'); ?>
		<?php echo $form->dropDownList($model,'mes_produccion',array(
                                                                '01'=>'Enero',
                                                                '02'=>'Febrero',
                                                                '03'=>'Marzo',
                                                                '04'=>'Abril',
                                                                '05'=>'Mayo',
                                                                '06'=>'Junio',
                                                                '07'=>'Julio',
                                                                '08'=>'Agosto',
                                                                '09'=>'Septiembre',
                                                                '10'=>'Octubre',
                                                                '11'=>'Noviembre',
                                                                '12'=>'Diciembre',),array('empty'=>'Seleccione un mes')); ?>
		<?php echo $form->error($model,'mes_produccion'); ?>
	
        </div>
        
        
        </fieldset>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

        