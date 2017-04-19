<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

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

        <?php $htmlOptions=array(
                'empty'=>'Seleccione un tipo o perfil',
                'ajax'=>array(
                    'url'=>$this->createUrl("jefesPorUsuario"),
                    'type'=>"POST",
                    'update'=>"#Usuario_rut_padre"),
            
        );?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php
                echo $form->dropDownList($model,'tipo',array(   'administrador'=>'Administrador'
                                                                ,'jefe de venta'=>'Jefe de Ventas'
                                                                ,'supervisor'=>'Supervisor' 
                                                                ,'ejecutivo'=>'Ejecutivo'),$htmlOptions);?>                   
                             
                            
                <?php echo $form->error($model,'tipo'); ?>
	</div>
        

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
		<?php echo $form->error($model,'fecha_ingreso'); ?>
	</div>
       
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rut_padre'); ?>
		<?php 
               
                $lista_dos = CHtml::listData(Usuario::model()->findAll("rut = ? and estado='Activo'",array('rut')),'rut',"nombre"." "."apllido");
                              
                echo $form->dropDownList($model,'rut_padre',$lista_dos,array('empty'=>'Seleccione un Jefe')); ?>
               
		<?php echo $form->error($model,'rut_padre'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Guardar Datos'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->