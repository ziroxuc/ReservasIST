<script type="text/javascript">
$(document).ready(function(){
    
    
    
  
    $('#RutMalo').hide();
    $('#FichaVisita_rut_empresa').Rut({
      on_error: function(){ 
          $('#RutMalo').show();
        },
      on_success: function(){ 
            $('#RutMalo').hide();
        },
      format_on: 'keyup' 
      //format: false
    });
     
});
</script> 
<?php
/* @var $this FichaVisitaController */
/* @var $model FichaVisita */
/* @var $form CActiveForm */
?>

<div class="form">
  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ficha-visita-form',
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
	<p class="note">Todos los campos con * son requeridos.</p>
        
        <div class="row">
		<?php echo $form->labelEx($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>20,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'rut_empresa',array('id'=>'errorRut')); ?>
                <div class="alert alert-danger" id="RutMalo" style="width: 120px; float: left; margin-left: 5px; height: 11px;">
                    Rut incorrecto!
                </div>
	</div>
        
          <div class="row">
		<?php echo $form->labelEx($model,'rut_eje'); ?>
                    <?php 
               
                $lista_tres = array();
                $rut_sup = Yii::app()->user->getState('rut'); 
                $user=new SolicitudContrato();
                $lista_tres = $user->getEjecu($rut_sup);
                
                echo $form->dropDownList($model,'rut_eje',$lista_tres,
                        array('prompt'=>'Seleccione ejecutivo')
                        ); ?>
		<?php echo $form->error($model,'rut_eje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre_empresa'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'cantidad_trab'); ?>
		<?php echo $form->textField($model,'cantidad_trab'); ?>
		<?php echo $form->error($model,'cantidad_trab'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_empresa'); ?>
		<?php echo $form->textField($model,'direccion_empresa',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'direccion_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comuna_empresa'); ?>
			<?php echo $form->dropDownList($model,'comuna_empresa',array(
                         'Cerro Navia'=>'Cerro Navia','Conchalí'=>'Conchalí','Estación Central'=>'Estación Central'
                        ,'Huechuraba'=>'Huechuraba','Independencia'=>'Independencia'
                        ,'Lo Prado'=>'Lo Prado','Pudahuel'=>'Pudahuel','Quilicura'=>'Quilicura','Quinta Normal'=>'Quinta Normal','Recoleta'=>'Recoleta'
                        ,'Renca'=>'Renca','Santiago'=>'Santiago','San Bernardo'=>'San Bernardo','Cerrillos'=>'Cerrillos','El Bosque'=>'El Bosque'
                        ,'La Cisterna'=>'La Cisterna','La Granja'=>'La Granja','La Pintana'=>'La Pintana'
                        ,'Lo Espejo'=>'Lo Espejo','Macul'=>'Macul','Maipú'=>'Maipú'
                        ,'Ñuñoa'=>'Ñuñoa','Pedro Aguirre Cerda'=>'Pedro Aguirre Cerda','San Miguel'=>'San Miguel'
                        ,'San Joaquín'=>'San Joaquín','San Ramón'=>'San Ramón','Padre Hurtado'=>'Padre Hurtado','Puente Alto'=>'Puente Alto','La Florida'=>'La Florida'
                        ,'La Reina'=>'La Reina','Las Condes'=>'Las Condes','Lampa'=>'Lampa'
                        ,'Lo Barnechea'=>'Lo Barnechea','Peñalolén'=>'Peñalolén','Providencia'=>'Providencia','Vitacura'=>'Vitacura'
                                                      
                    )
                        ,array('empty'=>'Seleccione una Comuna')); ?>
		<?php echo $form->error($model,'comuna_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fono_empresa'); ?>
		<?php echo $form->textField($model,'fono_empresa',array('size'=>20,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'fono_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_contacto'); ?>
		<?php echo $form->textField($model,'nombre_contacto'); ?>
		<?php echo $form->error($model,'nombre_contacto'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'fecha_visita');
                $diaSemana=date("N"); 
                if(Yii::app()->user->getState('rut')=="14198477-2"){
                   $fechaMin="-5D"; 
                }elseif($diaSemana==1){
                    $fechaMin="-3D";
                }else{$fechaMin="-1D";}
                ?>
		<?php 
                
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_visita',
                        'value'=>$model->fecha_visita,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'attribute'=>'fecha_visita',
                        'options'   => array(
                                'changeYear' => true,
                                'dateFormat' => 'mm/dd/yy',
                                //'timeFormat' => '',//'hh:mm tt' default
                                'beforeShowDay'=>'js:function(date){ 
                                          var day = date.getDay();
                                          
                                          var dias=[day == 1|| day == 2|| day == 3|| day == 4|| day == 5,""];


                                          return dias;
                                        }',
                                'autoSize'=>true,
                        'defaultDate'=>$model->fecha_visita,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_visita',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>$fechaMin, //fecha minima
                        'maxDate'=> "-0D", //fecha maxima
                            
                            
                            
                        ),
                ));
                
                Yii::app()->clientScript->registerScript('editDays', "
                function editDays(date) {
                                                //alert('hello!');                              
                                                var disabledDates = ['09/25/2014', '09/23/2014', '09/21/2014'];
                                        for (var i = 0; i < disabledDates.length; i++) {
                                        if (new Date(disabledDates[i]).toString() == date.toString()) {
                                                return [false,''];
                                        }
                                        }
                                        return [true,''];
                                }
                ");                
                ?>
		<?php echo $form->error($model,'fecha_visita'); ?>
	</div>
        
        
        <div class="row">
		<?php echo $form->labelEx($model,'fech_pos_cierre'); ?>
		<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fech_pos_cierre',
                        'value'=>$model->fech_pos_cierre,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                             'beforeShowDay'=>'js:function(date){ 
                                          var day = date.getDay();
                                          
                                          var dias=[day == 1|| day == 2|| day == 3|| day == 4|| day == 5,""];


                                          return dias;
                                        }',
                        'autoSize'=>true,
                        'defaultDate'=>$model->fech_pos_cierre,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fech_pos_cierre',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'0D', //fecha minima
                        'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
		<?php echo $form->error($model,'fech_pos_cierre'); ?>
	</div>
        
        
       <div class="row">
            <?php echo $form->labelEx($model,'comentario'); ?>
            <?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50,'class'=>'span6')); ?>
            <?php echo $form->error($model,'comentario'); ?>
        </div>
        
        
        
        <!--
        Modal para completar la autoevaluación
        -->
   <div id="Autoev" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>    
        <h4 class="modal-title">Ficha de Autoevaluación</h4>
    </div>
    <div class="modal-body"> 
        
        
        <table class="table table-striped">
            <tr>
                <td>N° Pregunta</td><td>Cumple</td><td>No cumple</td><td>No aplica</td>
            </tr>
            <tr>
                <td><p>GTL1</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL1'); ?></div></td>
                <td><?php echo $form->radioButton($model, 'GTL1', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL1', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL1', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
                
            </tr> 
            <tr>
                <td><p>GTL2</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL2'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL2', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL2', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL2', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            <tr>
                <td><p>GTL3</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL3'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL3', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL3', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL3', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            <tr>
                <td><p>GTL4</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL4'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL4', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL4', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL4', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr>
            <tr>
                <td><p>GTL5</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL5'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL5', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL5', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL5', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            <tr>
                <td><p>GTL6</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL6'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL6', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL6', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL6', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            <tr>
                <td><p>GTL7</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL7'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL7', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL7', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL7', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            <tr>
                <td><p>GTL8</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL8'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL8', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL8', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL8', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            <tr>
                <td><p>GTL9</p><div style="margin-left: 20px; margin-top: -35px;"><?php echo $form->error($model,'GTL9'); ?></div></td>
               
                <td><?php echo $form->radioButton($model, 'GTL9', array('value'=>'Cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL9', array('value'=>'No cumple','uncheckValue'=>null)); ?></td>
                <td><?php echo $form->radioButton($model, 'GTL9', array('value'=>'No aplica','uncheckValue'=>null)); ?></td>
            </tr> 
            
        </table>   
      
    </div>
    <div class="modal-footer">
         <a href="#" class="btn" data-dismiss="modal">Salir</a>
         <?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar Autoevaluación' : 'Guardar',array('class'=>"btn btn-primary",'id'=>'agregarAutoev')); ?>
    </div> 
</div>  
        
        	
	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Agregar Autoevaluación' : 'Guardar'); ?>
                
            <button class="btn btn-primary btn-lg" style="padding: 6.5px; margin-left: 150px;" data-toggle="modal" data-target="#Autoev">
             Agregar Ficha de Autoevaluación
        </button>
        
        </div>
        

<?php $this->endWidget(); ?>

</div><!-- form -->