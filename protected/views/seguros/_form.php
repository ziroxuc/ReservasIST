<?php
/* @var $this SegurosController */
/* @var $model Seguros */
/* @var $form CActiveForm */
?>

<form class="form-inline" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguros-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,)
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
        <?php echo CHtml::errorSummary($model); ?>
	      <fieldset>
        <legend>Personal:</legend>
        
	<div class="row">
		<?php echo $form->labelEx($model,'rut_jv'); ?>
		<?php echo $form->dropDownList($model,'rut_jv',array('14198477-2'=>'Emmanuel Segura'
                                                                ,'8820971-0'=>'Francisco Diaz'
                                                                ,'16666225-7'=>'Adolfo Gómez'),  array(
                            'ajax'=>array(
                              'type'=>'POST',
                              'url'=>CController::createUrl('seguros/supervisorPorJV'),
                              'update'=>'#'.CHtml::activeId($model,'rut_sup'),
                              'beforeSend' => 'function(){
                               $("#Seguros_rut_sup").find("option").remove();
                               $("#Seguros_rut_ejecutivo").find("option").remove();
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
                $lista_dos = CHtml::listData(Usuario::model()->findAll("rut_padre = '$rut_jv'"),'rut',"nombre"." "."apellido");
                }                
                echo $form->dropDownList($model,'rut_sup',$lista_dos,
                        array(
                            'ajax'=>array(
                              'type'=>'POST',
                              'url'=>CController::createUrl('seguros/ejecutivoPorSup'),
                              'update'=>'#'.CHtml::activeId($model,'rut_ejecutivo'),
                              'beforeSend' => 'function(){
                              $("#Seguros_rut_ejecutivo").find("option").remove();
                               }', 
                            ),
                            'prompt'=>'Seleccione supervisor')
                        ); ?>
                
		<?php echo $form->error($model,'rut_sup'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'rut_ejecutivo'); ?>
                    <?php 
                $lista_tres = array();
                if(isset($model->rut_ejecutivo)){
                $rut_sup = $model->rut_sup; 
                $lista_tres = CHtml::listData(Usuario::model()->findAll("rut_padre = '$rut_sup'"),'rut',"nombre"." "."apellido");
                }
                echo $form->dropDownList($model,'rut_ejecutivo',$lista_tres,
                        array('prompt'=>'Seleccione ejecutivo')
                        ); ?>
            
		<?php echo $form->error($model,'rut_ejecutivo'); ?>
	</div>
        
         </fieldset>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fecha_vigencia',array('class'=>'sr-only') ); ?>
			<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_vigencia',
                        'value'=>$model->fecha_vigencia,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly",'class'=>'form-control'),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->fecha_vigencia,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_vigencia',
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
		<?php echo $form->error($model,'fecha_vigencia',array('class'=>'sr-only')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fecha_ingreso'); ?>
			<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_ingreso',
                        'value'=>$model->fecha_ingreso,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly",'class'=>'form-control'),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->fecha_ingreso,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_ingreso',
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
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rut'); ?>
		<?php echo $form->textField($model,'rut'); ?>
		<?php echo $form->error($model,'rut'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
		<?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'fecha_nacimiento',
                        'value'=>$model->fecha_nacimiento,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->fecha_nacimiento,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_nacimiento',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-90Y', //fecha minima
                        'maxDate'=> "0D", //fecha maxima
                        ),
                        )); ?>
		<?php echo $form->error($model,'fecha_nacimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
			<?php echo $form->dropDownList($model,'sexo',
                                                                  array('F'=>'Femenino'
                                                                       ,'M'=>'Masculino'),
                                array('empty'=>'Seleccione sexo')); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comuna'); ?>
			<?php echo $form->dropDownList($model,'comuna',array(
                         'Colina'=>'Colina'
                        ,'Lampa'=>'Lampa'
                        ,'Tiltil'=>'Tiltil'
                        ,'Pirque'=>'Pirque'
                        ,'Puente Alto'=>'Puente Alto'
                        ,'San José de Maipo'=>'San José de Maipo'
                        ,'Buin'=>'Buin'
                        ,'Calera de Tango'=>'Calera de Tango'
                        ,'Paine'=>'Paine'
                        ,'San Bernardo'=>'San Bernardo'
                        ,'Alhué'=>'Alhué'
                        ,'Curacaví'=>'Curacaví'
                        ,'María Pinto'=>'María Pinto'
                        ,'Melipilla'=>'Melipilla'
                        ,'San Pedro'=>'San Pedro'
                        ,'Cerrillos'=>'Cerrillos'
                        ,'Cerro Navia'=>'Cerro Navia'
                        ,'Conchalí'=>'Conchalí'
                        ,'El Bosque'=>'El Bosque'
                        ,'Estación Central'=>'Estación Central'
                        ,'Huechuraba'=>'Huechuraba'
                        ,'Independencia'=>'Independencia'
                        ,'La Cisterna'=>'La Cisterna'
                        ,'La Granja'=>'La Granja'
                        ,'La Florida'=>'La Florida'
                        ,'La Pintana'=>'La Pintana'
                        ,'La Reina'=>'La Reina'
                        ,'Las Condes'=>'Las Condes'
                        ,'Lo Barnechea'=>'Lo Barnechea'
                        ,'Lo Espejo'=>'Lo Espejo'
                        ,'Lo Prado'=>'Lo Prado'
                        ,'Macul'=>'Macul'
                        ,'Maipú'=>'Maipú'
                        ,'Ñuñoa'=>'Ñuñoa'
                        ,'Pedro Aguirre Cerda'=>'Pedro Aguirre Cerda'
                        ,'Peñalolén'=>'Peñalolén'
                        ,'Providencia'=>'Providencia'
                        ,'Pudahuel'=>'Pudahuel'
                        ,'Quilicura'=>'Quilicura'
                        ,'Quinta Normal'=>'Quinta Normal'
                        ,'Recoleta'=>'Recoleta'
                        ,'Renca'=>'Renca'
                        ,'San Miguel'=>'San Miguel'
                        ,'San Joaquín'=>'San Joaquín'
                        ,'San Ramón'=>'San Ramón'
                        ,'Santiago'=>'Santiago'
                        ,'Vitacura'=>'Vitacura'
                        ,'El Monte'=>'El Monte'
                        ,'Isla de Maipo'=>'Isla de Maipo'
                        ,'Padre Hurtado'=>'Padre Hurtado'
                        ,'Peñaflor'=>'Peñaflor'
                        ,'Talagante'=>'Talagante'                                             
                    )
                        ,array('empty'=>'Seleccione una Comuna')); ?>
		<?php echo $form->error($model,'comuna'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
			<?php echo $form->dropDownList($model,'region',array(
                     'Metropolitana'=>'Metropolitana'        
                    ,'Tarapacá'=>'Tarapacá'
                    ,'Antofagasta'=>'Antofagasta'
                    ,'Atacama'=>'Atacama'
                    ,'Coquimbo'=>'Coquimbo'
                    ,'Valparaíso'=>'Valparaíso'
                    ,'Bernardo O´Higgins'=>'Bernardo O´Higgins'
                    ,'Maule'=>'Maule'
                    ,'Bío Bío'=>'Bío Bío'
                    ,'Araucanía'=>'Araucanía'
                    ,'los Lagos'=>'los Lagos'
                    ,'Aisén'=>'Aisén'
                    ,'Magallanes y Antártica Chilena'=>'Magallanes y Antártica Chilena'
                    ,'Los Ríos'=>'Los Ríos'
                    ,'Arica y Parinacota'=>'Arica y Parinacota')
                        ,array('empty'=>'Seleccione una Región')); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fono_particular'); ?>
		<?php echo $form->textField($model,'fono_particular',array('size'=>45,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'fono_particular'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'celular'); ?>
		<?php echo $form->textField($model,'celular',array('size'=>45,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'celular'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<!-- FALTA PRODUCTO -->

	<div class="row">
		<?php echo $form->labelEx($model,'plan'); ?>
		<?php echo $form->dropDownList($model,'plan',array(
                     '1'=>'Plan 1'
                    ,'2'=>'Plan 2'
                    ,'3'=>'Plan 3')
                        ,array('empty'=>'Seleccione un Plan')); ?>
		<?php echo $form->error($model,'plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'odonto_individual'); ?>
		<?php echo $form->dropDownList($model,'odonto_individual',array(
                            '0'=>'No'
                           ,'1'=>'Si')
                        ,array('empty'=>'Seleccione un Plan de odonto individual')); ?>
		<?php echo $form->error($model,'odonto_individual'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'odonto_familiar'); ?>
			<?php echo $form->dropDownList($model,'odonto_familiar',array(
                            '0'=>'No'
                           ,'1'=>'Si')
                        ,array('empty'=>'Seleccione un Plan de Odonto familiar')); ?>
		<?php echo $form->error($model,'odonto_familiar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'renta_mensual'); ?>
                <?php echo $form->dropDownList($model,'renta_mensual',array(
                            '0'=>'Ninguno'
                           ,'1'=>'Plan 1'
                           ,'2'=>'Plan 2'
                           ,'3'=>'Plan 3')
                        ,array('empty'=>'Seleccione la renta mensual')); ?>
		<?php echo $form->error($model,'renta_mensual'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'interven_quirurgicas'); ?>
                     <?php echo $form->dropDownList($model,'interven_quirurgicas',array(
                            '0'=>'Ninguno'
                           ,'1'=>'Plan 1'
                           ,'2'=>'Plan 2'
                           ,'3'=>'Plan 3')
                        ,array('empty'=>'Seleccione Intervencion quirurgica')); ?>
		<?php echo $form->error($model,'interven_quirurgicas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inicio_cobranza'); ?>
		<?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'inicio_cobranza',
                        'value'=>$model->inicio_cobranza,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$model->inicio_cobranza,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'inicio_cobranza',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-90Y', //fecha minima
                        'maxDate'=> "3M", //fecha maxima
                        ),
                        )); ?>
		<?php echo $form->error($model,'inicio_cobranza'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'via_pago'); ?>
                <?php echo $form->dropDownList($model,'via_pago',array(
                            'BAN'=>'BAN'
                           ,'TBK'=>'TBK'
                           ,'PLA'=>'PLA')
                        ,array('empty'=>'Seleccione la via de pago')); ?>
		<?php echo $form->error($model,'via_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'banco'); ?>
                <?php echo $form->dropDownList($model,'banco',array(
                         '1'=>'BANCO CREDITO E INVERSIONES'
                        ,'2'=>'BANCO DE CHILE'
                        ,'3 '=>'CORPBANCA'
                        ,'4'=>'SCOTIABANK'
                        ,'5 '=>'BANCO SANTANDER-SANTIAGO'
                        ,'6'=>'CITIBANK'
                        ,'7 '=>'BANCO DEL DESARROLLO'
                        ,'8 '=>'BANCO BBVA'
                        ,'9 '=>'BANCO BICE'
                        ,'10 '=>'BANCO DE A. EDWARDS'
                        ,'11'=>'BANCO SANTANDER SANTIAGO'
                        ,'12 '=>'BANCO DEL ESTADO DE CHILE'
                        ,'13 '=>'BANCO ITAU'
                        ,'14'=>'BANCO SECURITY'
                        ,'15 '=>'BANCO FALABELLA')
                        ,array('empty'=>'Seleccione el banco')); ?>
		<?php echo $form->error($model,'banco'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num_cta_corriente'); ?>
		<?php echo $form->textField($model,'num_cta_corriente',array('size'=>45,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'num_cta_corriente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num_tarjeta'); ?>
		<?php echo $form->textField($model,'num_tarjeta',array('size'=>45,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'num_tarjeta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_sucursal'); ?>
		       <?php echo $form->dropDownList($model,'codigo_sucursal',array(
                           '1'=>'Santiago'
                          ,'2'=>'Viña del mar')
                        ,array('empty'=>'Seleccione sucursal')); ?>
		<?php echo $form->error($model,'codigo_sucursal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>45,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'rut_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contacto_empresa'); ?>
		<?php echo $form->textField($model,'contacto_empresa',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'contacto_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_empresa'); ?>
		<?php echo $form->textField($model,'direccion_empresa',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'direccion_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_empresa'); ?>
		<?php echo $form->textField($model,'telefono_empresa',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telefono_empresa'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->



<form class="form-horizontal">

  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Contraseña</label>
    <div class="col-lg-10">
      <input type="password" class="form-control" id="ejemplo_password_3" placeholder="Contraseña">
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Contraseña</label>
    <div class="col-lg-10">
      <input type="password" class="form-control" id="ejemplo_password_3" placeholder="Contraseña">
    </div>
  </div>  
    
    
    
      <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Contraseña</label>
    <div class="col-lg-2">
      <input type="password" class="form-control" id="ejemplo_password_3" placeholder="Contraseña">
    </div>
  </div>
  <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Contraseña</label>
    <div class="col-lg-10">
      <input type="password" class="form-control" id="ejemplo_password_3" placeholder="Contraseña">
    </div>
  </div> 
    
</form>