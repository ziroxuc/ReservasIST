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
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            
        )

)); ?>
    
        
    <legend>Empresa:</legend>
        
	<div class="row">
		<?php echo $form->labelEx($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>12,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rut_empresa'); ?>
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
                                                                  ,'ACHS'=>'Asociación chilena de seguridad'),array('empty'=>'Seleccione un Origen')); ?>
		<?php echo $form->error($model,'origen_emp'); ?>
	</div>
    
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
                        'minDate'=>'-3M', //fecha minima
                        'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
		<?php echo $form->error($model,'fecha_ingreso'); ?>
	</div>
    
    
        <div class="row">
		<?php echo $form->labelEx($model,'vigencia'); ?>
		<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'vigencia',
                        'value'=>$model->vigencia,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->vigencia,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'vigencia',
                        'selectOtherMonths'=>true,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-2M', //fecha minima
                        'maxDate'=> "2M", //fecha maxima
                        'timeOnly' => true,
                        ),
                        )); ?>
		<?php echo $form->error($model,'vigencia'); ?>
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
                        'minDate'=>'-6M', //fecha minima
                        'maxDate'=> "4M", //fecha maxima
                        'timeOnly' => true,
                        ),
                        )); ?>
		<?php echo $form->error($model,'fecha_cambio_estado'); ?>
	</div>
    
        

        </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->