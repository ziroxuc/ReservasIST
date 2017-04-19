<?php
/* @var $this SegurosController */
/* @var $model Seguros */

$this->breadcrumbs=array(
	'Seguros'=>array('admin'),
	'Crear un seguro Derivado',
);

$this->menu=array(
	
	array('label'=>'Administrar Seguros', 'url'=>array('admin')),
);
?>

<h1>Crear Seguros derivados</h1>

<div class="form">

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
        
        <fieldset>
        <legend>Datos seguro derivado:</legend>

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
    </fieldset>
<?php $this->endWidget(); ?>
        
</div><!-- form -->