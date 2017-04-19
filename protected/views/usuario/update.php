<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->rut=>array('view','id'=>$model->rut),
	'Editar Usuarios',
);

$this->menu=array(
	
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->rut)),
	array('label'=>'Administrar Usuarios', 'url'=>array('admin')),
        array('label'=>'Modificar dependencia', 'url'=>array('#Dependencia'),'linkOptions'=>array('data-toggle'=>'modal'),),
);
?>

<h1>Editar Usuario <?php echo $model->rut; ?></h1>

<div class="form">
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
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

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
        
          <fieldset>
        <legend>Datos personales:</legend>

	<div class="row">
		<?php echo $form->labelEx($model,'rut'); ?>
		<?php echo $form->textField($model,'rut',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rut'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_ingreso'); ?>
		<?php 
                 $this->widget('zii.widgets.jui.CJuiDatePicker',
                        array(
                         'model'=>$model,
                         'attribute'=>'fecha_ingreso',
                         'language'=>'es',
                         'options'=>array(
                             'dateFormat'=>'yy-mm-dd',
                             'constrainInput'=>'false',
                             'duration'=>'fast',
                             'showAnim'=>'slide',
                             ), 
                         )
                  );
                ?>
		<?php echo $form->error($model,'fecha_salida'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'fecha_salida'); ?>
		<?php 
                 $this->widget('zii.widgets.jui.CJuiDatePicker',
                        array(
                         'model'=>$model,
                         'attribute'=>'fecha_salida',
                         'language'=>'es',
                         'options'=>array(
                             'dateFormat'=>'yy-mm-dd',
                             'constrainInput'=>'false',
                             'duration'=>'fast',
                             'showAnim'=>'slide',
                             ), 
                         )
                  );
                ?>
		<?php echo $form->error($model,'fecha_ingreso'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php
                echo $form->dropDownList($model,'estado',array(  
                                                                'Activo'=>'Activo' 
                                                               ,'Inactivo'=>'Inactivo'
                                                               ,'En regularizacion'=>'En regularización'));?>                   
                <?php echo $form->error($model,'estado'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

        </fieldset>
        
	<div class="row buttons">
            <?php echo CHtml::button('Cancelar', array('submit' => array('usuario/admin')));?>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Guardar Datos'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<!-- ----------------------------------MODAL------------------------------------->


<div id="Dependencia" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="cerrar">X</button>    
        <h4 class="modal-title">Modificar dependencias</h4>
    </div>
    <div class="modal-body">
       
        <h5>Dependencia actual:</h5>
        <?php 
        $x = new Usuario();
        if($model->tipo=="ejecutivo"){
         echo "<b> Jefe de venta: ".$x->getNombreJV($model->rut)."</b><br><b>Supervisor: ".$x->getNombreSup($model->rut)."<b><br>";
         echo "Ejecutivo: ".$model->nombre." ".$model->apellido;
        }else{
         echo $x->getNombreJV($model->rut);  
        }
        
        
        ?>
        
        
        
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'modificaDependencia',
            'method'=>'post',
             'id'=>'dependencias-modal-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             )
     )); ?> 
        
        <?php echo $form->hiddenField($model,'rut'); ?>
        <?php echo $form->hiddenField($model,'nombre'); ?>
        <?php echo $form->hiddenField($model,'apellido'); ?>
        <?php echo $form->hiddenField($model,'tipo'); ?>
        <?php echo $form->hiddenField($model,'estado'); ?>
        <?php echo $form->hiddenField($model,'fecha_ingreso'); ?>
        <?php echo $form->hiddenField($model,'fecha_salida'); ?>
        
        <hr>  
        <h5>Dependencia anterior:</h5><br>
        <div class="row">
     <?php echo $form->labelEx($dependencia,'fech_termino_depen'); ?>
     <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$dependencia,
                        'attribute'=>'fech_termino_depen',
                        'value'=>$dependencia->fech_termino_depen,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),

                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$dependencia->fech_termino_depen,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fech_termino_depen',
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
     <?php echo $form->error($dependencia,'fech_termino_depen'); ?>
    
    </div>
        
        <hr>  
        <h5>Nueva dependencia:</h5><br>
        
        <div class="row">
		<?php echo $form->labelEx($dependencia,'dependencia_jv'); ?>
                
		<?php
                $lista_dos = $model->getAllJV();
                echo $form->dropDownList($dependencia,'dependencia_jv',$lista_dos,array('empty'=>'Seleccione un Jefe')); ?>
                
		<?php echo $form->error($dependencia,'dependencia_jv'); ?>
	</div>
        
        
        <div class="row">
		<?php echo $form->labelEx($dependencia,'dependencia_sup'); ?>
		<?php
                $lista_dosd = $model->getAllSup();
                echo $form->dropDownList($dependencia,'dependencia_sup',$lista_dosd,array('empty'=>'Seleccione un Jefe')); ?>
             
       
		<?php echo $form->error($dependencia,'dependencia_sup'); ?>
	</div>
        
        
        
    <div class="row">
     <?php echo $form->labelEx($dependencia,'fech_inicio_depen'); ?>
     <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$dependencia,
                        'attribute'=>'fech_inicio_depen',
                        'value'=>$dependencia->fech_inicio_depen,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$dependencia->fech_inicio_depen,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fech_inicio_depen',
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
     <?php echo $form->error($dependencia,'fech_inicio_depen'); ?>
    
    </div>
    
      
    </div>
    
    <div class="modal-footer">
         <a href="#" class="btn" data-dismiss="modal" id="salir">Salir</a>
         
         <?php echo CHtml::submitButton('Aceptar',array('class'=>"btn btn-primary")); ?>
       
    </div> 
    <?php $this->endWidget(); ?>
</div>  