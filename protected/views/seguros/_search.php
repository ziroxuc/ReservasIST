<?php
/* @var $this SegurosController */
/* @var $model Seguros */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_jv'); ?>
		<?php echo $form->textField($model,'rut_jv',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_jv'); ?>
		<?php echo $form->textField($model,'nombre_jv',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_sup'); ?>
		<?php echo $form->textField($model,'rut_sup',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_sup'); ?>
		<?php echo $form->textField($model,'nombre_sup',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_ejecutivo'); ?>
		<?php echo $form->textField($model,'rut_ejecutivo',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_ejecutivo'); ?>
		<?php echo $form->textField($model,'nombre_ejecutivo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero_certificado'); ?>
		<?php echo $form->textField($model,'numero_certificado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_vigencia'); ?>
		<?php echo $form->textField($model,'fecha_vigencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_ingreso'); ?>
		<?php echo $form->textField($model,'fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut'); ?>
		<?php echo $form->textField($model,'rut'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'digito'); ?>
		<?php echo $form->textField($model,'digito',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_nacimiento'); ?>
		<?php echo $form->textField($model,'fecha_nacimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comuna'); ?>
		<?php echo $form->textField($model,'comuna',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fono_particular'); ?>
		<?php echo $form->textField($model,'fono_particular',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'celular'); ?>
		<?php echo $form->textField($model,'celular',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'producto'); ?>
		<?php echo $form->textField($model,'producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plan'); ?>
		<?php echo $form->textField($model,'plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'odonto_individual'); ?>
		<?php echo $form->textField($model,'odonto_individual'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'odonto_familiar'); ?>
		<?php echo $form->textField($model,'odonto_familiar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'renta_mensual'); ?>
		<?php echo $form->textField($model,'renta_mensual'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interven_quirurgicas'); ?>
		<?php echo $form->textField($model,'interven_quirurgicas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prima_mensual_uf'); ?>
		<?php echo $form->textField($model,'prima_mensual_uf'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inicio_cobranza'); ?>
		<?php echo $form->textField($model,'inicio_cobranza'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'via_pago'); ?>
		<?php echo $form->textField($model,'via_pago',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banco'); ?>
		<?php echo $form->textField($model,'banco',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_banco'); ?>
		<?php echo $form->textField($model,'nombre_banco',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_cta_corriente'); ?>
		<?php echo $form->textField($model,'num_cta_corriente',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_tarjeta'); ?>
		<?php echo $form->textField($model,'num_tarjeta',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_sucursal'); ?>
		<?php echo $form->textField($model,'codigo_sucursal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rut_empresa'); ?>
		<?php echo $form->textField($model,'rut_empresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'digito_empresa'); ?>
		<?php echo $form->textField($model,'digito_empresa',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_empresa'); ?>
		<?php echo $form->textField($model,'nombre_empresa',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacto_empresa'); ?>
		<?php echo $form->textField($model,'contacto_empresa',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion_empresa'); ?>
		<?php echo $form->textField($model,'direccion_empresa',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono_empresa'); ?>
		<?php echo $form->textField($model,'telefono_empresa',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->