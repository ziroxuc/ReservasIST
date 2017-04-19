<?php
/* @var $this ReservasController */
/* @var $model Reservas */

$this->breadcrumbs=array(
	'Reservases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Reasignar',
);

$this->menu=array(
	
	array('label'=>'Crear Reservas', 'url'=>array('create')),
	array('label'=>'Administrar Reservas', 'url'=>array('admin')),
);
?>

<h1>Reasignar Reservas <?php echo $model->id; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reservas-form',
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

	<?php //echo $form->errorSummary($model); ?>
        
        <?php if(Yii::app()->user->getState("tipo")!=="ist"){?>
        
                <div class="row">
                        <?php echo $form->labelEx($model,'rut_empresa'); ?>
                        <?php echo $form->textField($model,'rut_empresa',array('size'=>45,'maxlength'=>45,'readonly'=>'readonly')); ?>
                        <?php echo $form->error($model,'rut_empresa'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'nombre_empresa'); ?>
                        <?php echo $form->textField($model,'nombre_empresa',array('size'=>45,'maxlength'=>45,'readonly'=>'readonly')); ?>
                        <?php echo $form->error($model,'nombre_empresa'); ?>
                </div>
        <hr>
                <div class="row">
                        <?php echo $form->labelEx($model,'rut_ejecutivo'); ?>
                        <?php echo $form->textField($model,'rut_ejecutivo',array('size'=>45,'maxlength'=>45)); ?>
                        <?php echo $form->error($model,'rut_ejecutivo'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'nombre_ejecutivo'); ?>
                        <?php echo $form->textField($model,'nombre_ejecutivo',array('size'=>45,'maxlength'=>45)); ?>
                        <?php echo $form->error($model,'nombre_ejecutivo'); ?>
                </div>
                
                 <div class="row">
                        <?php echo $form->labelEx($model,'tipo_reserva'); ?>
                     <?php echo $form->dropDownList($model,'tipo_reserva',array(   
                                                                 'GAP'=>'Gerencia adherentes pyme'
                                                                ,'GZ'=>'Gerencia zonal'
                                                                ,'GC'=>'Gerencia comercial'
                                                                ,'otros'=>'Otros ist'),array('empty'=>'Seleccione un tipo de ejecutivo'));?>   
                        <?php echo $form->error($model,'tipo_reserva'); ?>
                </div>
        
                    <div class="row">
                        <?php echo $form->labelEx($model,'estado'); ?>
                     <?php echo $form->dropDownList($model,'estado',array('GZ'=>'Reservada'),array('disabled'=>'disabled'));?>   
                        <?php echo $form->error($model,'estado'); ?>
                </div>
        
                <?php 
        
                }else{
                    ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'rut_empresa'); ?>
                        <?php echo $form->textField($model,'rut_empresa',array('size'=>45,'maxlength'=>45)); ?>
                        <?php echo $form->error($model,'rut_empresa'); ?>
                     </div>

                     <div class="row">
                        <?php echo $form->labelEx($model,'nombre_empresa'); ?>
                        <?php echo $form->textField($model,'nombre_empresa',array('size'=>45,'maxlength'=>45)); ?>
                        <?php echo $form->error($model,'nombre_empresa'); ?>
                     </div>
                     
                 <?php   
                }
                ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Generar reserva' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->