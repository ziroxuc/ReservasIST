<?php
/* @var $this SolicitudContratoController */
/* @var $model SolicitudContrato */
/* @var $form CActiveForm */
?>
<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-contrato-form',
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
    
   <?php // echo $form->errorSummary($model); ?>
    
       <fieldset>
        <legend>Personal:</legend>
        

	<div class="row">
		<?php echo $form->labelEx($model,'rut_jv'); ?>
		<?php echo $form->dropDownList($model,'rut_jv',array('14198477-2'=>'Emmanuel Segura'
                                                                ,'8820971-0'=>'Francisco Diaz'
                                                                ,'16666225-7'=>'Adolfo Gómez'),  array(
                            'ajax'=>array(
                              'type'=>'POST',
                              'url'=>CController::createUrl('SolicitudContrato/supervisorPorJV'),
                              'update'=>'#'.CHtml::activeId($model,'rut_sup'),
                              'beforeSend' => 'function(){
                               $("#SolicitudContrato_rut_sup").find("option").remove();
                               $("#SolicitudContrato_rut_ejecutivo").find("option").remove();
                               }',  
                            ),'prompt'=>'Seleccione jefe de venta'
                            
                            
                        ));?>   
		<?php echo $form->error($model,'rut_jv'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'rut_sup'); ?>
	<?php 
                $lista_dos = array();
                if(isset($model->rut_sup)){
                $rut_jv = $model->rut_jv; 
                $lista_dos = $model->getSup($rut_jv);
                }                
                echo $form->dropDownList($model,'rut_sup',$lista_dos,
                        array(
                            'ajax'=>array(
                              'type'=>'POST',
                              'url'=>CController::createUrl('SolicitudContrato/ejecutivoPorSup'),
                              'update'=>'#'.CHtml::activeId($model,'rut_ejecutivo'),
                              'beforeSend' => 'function(){
                              $("#SolicitudContrato_rut_ejecutivo").find("option").remove();
                               }',   
                                
                            ),
                            
                            'prompt'=>'Seleccione supervisor')
                        ); ?>
		<?php echo $form->error($model,'rut_sup'); ?>
	</div>
        
          <script type="text/javascript">
      $(document).ready(function(){
            $("#rutEje").hide();
            $('#SolicitudContrato_rut_ejecutivo').change(function (){
                var rut_ejecutivo=$('#SolicitudContrato_rut_ejecutivo').val();
                $("#rutEje").html(rut_ejecutivo).show();
                }); 
            });
        </script> 
        
        <div class="row">
		<?php echo $form->labelEx($model,'rut_ejecutivo'); ?>
                    <?php 
                $rut_sup="";    
                $lista_tres = array();
                if(isset($model->rut_ejecutivo)){
                $rut_sup = $model->rut_sup; 
                $lista_tres = $model->getEjecu($rut_sup);
                }
                echo $form->dropDownList($model,'rut_ejecutivo',$lista_tres,
                        array('prompt'=>'Seleccione ejecutivo')
                        ); ?>
            
		<?php echo $form->error($model,'rut_ejecutivo'); ?>
            <div id="rutEje" class="row" style="color: black; font-size: 16px; font-weight: bold; padding: 5px;">
                
            </div>
	</div>
        
        
         </fieldset>
    
        <fieldset>
            
            
    <legend>Empresa:</legend>
        <div class="row">
		<?php echo $form->labelEx($model,'fecha_solicitud'); ?>
		<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_solicitud',
                        'value'=>$model->fecha_solicitud,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->fecha_solicitud,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_solicitud',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-14M', //fecha minima
                        'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
		<?php echo $form->error($model,'fecha_solicitud'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>12,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rut_empresa'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'tipo_contrato'); ?>
		<?php echo $form->dropDownList($model,'tipo_contrato',array('Solicitud Empresa'=>'Solicitud Empresa'
                                                                  ,'Solicitud Independiente'=>'Solicitud Independiente'
                                                                  ,'Solicitud Casa Particular'=>'Solicitud Casa Particular'
                                                                  ,'Solicitud Independiente voluntario'=>'Solicitud Independiente voluntario'
                                                                  ),array('empty'=>'Seleccione Tipo de contrato')); ?>
		<?php echo $form->error($model,'tipo_contrato'); ?>
	</div>
    
      <script type="text/javascript">
      $(document).ready(function(){
        $('#empresaRelacionada').hide();
            $('#SolicitudContrato_tipo_contrato').change(function (){
                var opc=$('#SolicitudContrato_tipo_contrato').val(); 
                if(opc=='Solicitud Independiente voluntario'){
                    $('#empresaRelacionada').show();
                
                         $("#solicitud-contrato-form").submit(function () {  
                        if($("#SolicitudContrato_empresa_relacionada").val().length < 1) {  
                            alert("Debe ingresar la empresa relacionada."); 
                            return false;
                        }      
                }); 
        
                }else{
                    $('#empresaRelacionada').hide();
                }
            });
         }); 
        </script> 
    
    <div class="row" id="empresaRelacionada">
		<?php echo $form->labelEx($model,'empresa_relacionada'); ?>
		<?php echo $form->textField($model,'empresa_relacionada',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'empresa_relacionada'); ?>
    </div>
        

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombre_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_contacto_emp'); ?>
		<?php echo $form->textField($model,'nombre_contacto_emp',array('size'=>60,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nombre_contacto_emp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_contacto_emp'); ?>
		<?php echo $form->textField($model,'telefono_contacto_emp',array('size'=>15,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'telefono_contacto_emp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_trabajadores'); ?>
		<?php echo $form->textField($model,'cantidad_trabajadores',array('size'=>15,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'cantidad_trabajadores'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origen_emp'); ?>
		<?php echo $form->dropDownList($model,'origen_emp',array('Nueva'=>'Nueva'
                                                                  ,'ISL'=>'ISL'
                                                                  ,'CCHC'=>'Mutual de Seguridad'
                                                                  ,'ACHS'=>'Asociación chilena de seguridad'
                                                                  ,'Sin información'=>'Sin información'
                                                                    ),array('empty'=>'Seleccione un Origen')); ?>
		<?php echo $form->error($model,'origen_emp'); ?>
	</div>
        
    
        <div class="row">
		<?php echo $form->labelEx($model,'codigo_actividad'); ?>
		<?php echo $form->textField($model,'codigo_actividad',array('size'=>15,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'codigo_actividad'); ?>
	</div>
    
        <?php if(!$model->isNewRecord){?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'fecha_ingreso'); ?>
		<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_ingreso',
                        'value'=>$model->fecha_ingreso,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->fecha_ingreso,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_solicitud',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-14M', //fecha minima
                        'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
		<?php echo $form->error($model,'fecha_ingreso'); ?>
	</div>

       <div class="row">
		<?php echo $form->labelEx($model,'fecha_cambio_estado'); ?>
		<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_cambio_estado',
                        'value'=>$model->vigencia,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                            'onSelect'=>'js:function(i,j){

                       function JSClock() {
                          var time = new Date();
                          var hour = time.getHours();
                          var minute = time.getMinutes();
                          var second = time.getSeconds();
                          var temp="";
                          temp +=(hour<10)? "0"+hour : hour;
                          temp += (minute < 10) ? ":0"+minute : ":"+minute ;
                          temp += (second < 10) ? ":0"+second : ":"+second ;
                          return temp;
                        }

                        $v=$(this).val();
                        $(this).val($v+" "+JSClock());
                          
                 }',
                        'autoSize'=>true,
                        'defaultDate'=>$model->fecha_cambio_estado,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_cambio_estado',
                        'selectOtherMonths'=>true,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-14M', //fecha minima
                        'maxDate'=> "4M", //fecha maxima
                        'timeOnly' => true,
                        ),
                        )); ?>
		<?php echo $form->error($model,'fecha_cambio_estado'); ?>
	</div>
        <div class="row">
            <?php echo $form->labelEx($model,'comentario_fech_vali'); ?>
            <?php echo $form->textArea($model,'comentario_fech_vali',array('rows'=>3, 'cols'=>50)); ?>
            <?php echo $form->error($model,'comentario_fech_vali'); ?>
        </div>
    
        <?php }?>
        
        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->