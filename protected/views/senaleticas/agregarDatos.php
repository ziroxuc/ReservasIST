 <script>
$("document").ready(function () {
    
    $("#senaleticas-datos-form").submit(function() {
        var fecharecep   = $('#Senaleticas_fecha_recepcion').val().trim();
        var nombreRecibe = $('#Senaleticas_nombre_recibe').val().trim();
        var cargo        = $('#Senaleticas_cargo').val().trim();
        var tel          = $('#Senaleticas_telefono').val().trim();
        var nomPaga      = $('#Senaleticas_nombre_pago').val().trim();
        var telPaga      = $('#Senaleticas_telefono_pago').val().trim();
        
    if (fecharecep === ''|| nombreRecibe === ''|| cargo === ''|| tel === ''|| nomPaga === ''|| telPaga === '') {
                alert('Todos los campos son obligatorios');
                return false;
        }else{
            return true;
        }
  });
        
});
        
    </script>   
<?php

$this->breadcrumbs=array(
	'Senaleticas'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Completar datos',
);

$this->menu=array(
	array('label'=>'Administrar Señaleticas', 'url'=>array('admin')),
);
?>

<h1>Completar datos <?php echo $model->id; ?></h1>

<div class="form">
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'senaleticas-datos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
       
        'enableClientValidation'=>false,
       
)); ?>

        
        <div class="row">
		<?php echo $form->labelEx($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>10,'maxlength'=>40,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'nombre_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa',array('size'=>45,'maxlength'=>45,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'rut_empresa'); ?>
	</div>
        
        <hr>
        
        
        
        <div class="row">
		<?php echo $form->labelEx($model,'fecha_recepcion'); ?>
		<?php 
                 $this->widget('zii.widgets.jui.CJuiDatePicker',
                        array(
                         'model'=>$model,
                         'attribute'=>'fecha_recepcion',
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
		<?php echo $form->error($model,'fecha_recepcion'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_recibe'); ?>
		<?php echo $form->textField($model,'nombre_recibe',array('size'=>10,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nombre_recibe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo'); ?>
		<?php echo $form->textField($model,'cargo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_pago'); ?>
		<?php echo $form->textField($model,'nombre_pago',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_pago'); ?>
		<?php echo $form->textField($model,'telefono_pago',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'telefono_pago'); ?>
	</div>
        <div class="row buttons">
		<?php echo CHtml::submitButton('Terminar proceso'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
