<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>


<?php if(isset($_GET['id']) && $_GET['id']==='expire')
{
 ?>   

<div class="alert alert-danger"><h4><b>Por seguridad, su sesión a expirado... Favor de volver a iniciar sesión.</b></h4></div>

<?php
}

?>
<div class="form-signin">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
        'htmlOptions'=>array('class'=>'form-signin'),
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
        'focus'=>array($model,'rut'),
)); ?>


<h2 class="form-signin-heading">Iniciar Sesión</h2>
            
<script>
$(document).ready(function(){
   $("form#login-form #LoginForm_rut").rut();
   
});
</script>

                <?php //echo $form->labelEx($model,'Rut usuario (Ej:17345987k)'); ?>
		<?php echo $form->textField($model,'rut',array('class'=>'form-control','placeholder'=>'Rut (Ej:17345987-k)')); ?>
		
	
		<?php //echo $form->labelEx($model,'Contraseña'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>'Contraseña')); ?>
 
		<?php echo CHtml::submitButton('Entrar',array('class'=>'btn btn-lg btn-primary btn-block')); ?>
<br>
<?php echo $form->error($model,'rut',array('style'=>'color:red;')); ?>                  
<?php echo $form->error($model,'password',array('style'=>'color:red;')); ?>
                

<?php $this->endWidget(); ?>
</div><!-- form -->
