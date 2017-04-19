
<div class="row">
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'reporteNumerosEjecutivos',
            'method'=>'post',
             'id'=>'solicitud-contrato-modal-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
             'validateOnSubmit'=>true,
             )
     )); ?>  

     <?php echo $form->labelEx($buscar,'op'); ?>
     <?php echo $form->textField($buscar,'op',array()); ?>
     <?php echo $form->error($buscar,'op'); ?>
    
   <?php echo CHtml::submitButton('Crear',array('class'=>"btn btn-primary")); ?>
  </div>
    <?php $this->endWidget(); ?>

