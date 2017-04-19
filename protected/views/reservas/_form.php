<?php
/* @var $this ReservasController */
/* @var $model Reservas */
/* @var $form CActiveForm */
?>

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
        
        <?php if(Yii::app()->user->getState("tipo")==="Operaciones comerciales"){?>
        
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