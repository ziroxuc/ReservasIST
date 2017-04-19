<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ficha-visita-form',
        'action'=>'reporteVisitas',
        'method'=>'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
      
)); ?>

<h3>Resumen de Autoevaluaciones</h3>
<?php
echo CHtml::link('< Volver',Yii::app()->request->urlReferrer, array('class'=>'btn btn-primary','style'=>'float:right; margin-top:-30px;'));
?>
<div style="height: 20px;">

</div>

  <div class="row">
		<?php echo $form->labelEx($buscar,'Meta Diaria'); ?>
                <?php echo $form->dropDownList($buscar,'op',array(
                 '1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'
                 ,'13'=>'13','14'=>'14','15'=>'15')
                 ,array('empty'=>'Seleccione meta')); ?>
		<?php echo $form->error($buscar,'op'); ?>
</div>

  <div class="row">
		<?php echo $form->labelEx($buscar,'Dia'); ?>
		<?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$buscar,
                        'attribute'=>'rut',
                        'value'=>$buscar->rut,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$buscar->rut,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'rut',
                        'selectOtherMonths'=>true,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        'showOn'=>'button',
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'minDate'=>'-2M', //fecha minima
                        'maxDate'=> "0D", //fecha maxima
                        'timeOnly' => true,
                        ),
                        )); ?>
		<?php echo $form->error($buscar,'rut'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Aceptar'); ?>
</div>
<?php $this->endWidget(); ?>

<?php if(isset($tabla1)){?>

<h3>Detalle de Autoevaluaciones <?php echo "meta = ".$metaDiaria." fecha ".$fechaDiaria?> </h3>
<div style="height:10px;"> 

</div>
<?php
$this->menu=array(
	
	array('label'=>'Volver', 'url'=>array('FichaVisita/ContarVisitas')),
);
?>
<div style="height:10px;">
    
</div>
<h4>Resumen Francisco Diaz</h4>
<table class="table table-striped" border="1"> 
    <thead>
    <tr>
        <td><b>Nombre</b></td>
        <td><b>Autoevaluaciones diarias</b></td>
        <td><b>Meta diaria</b></td>
        <td><b>Autoevaluaciones Ingresadas</b></td>
        <td><b>Meta mensual</b></td>
    </tr> 
   </thead>
   <tbody>
       <tr>
        <td style="background-color: #E0E6F8;"><b><?php echo $nombreJV1; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $reunionDiariaJV1; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $metaDiariaJV1; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $reunionMensualJV1; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $metaMensualJV1; ?></b></td>
       </tr>
     <?php foreach($tabla1 as $data1){ ?>
       <tr>
        <?php echo $data1; ?>
       </tr>
    <?php } ?>
    </tbody> 
</table>
<br>
<h4>Resumen Emmanuel Segura</h4>
<table class="table table-striped" border="1"> 
    <thead>
    <tr>
        <td><b>Nombre</b></td>
        <td><b>Autoevaluaciones diarias</b></td>
        <td><b>Meta diaria</b></td>
        <td><b>Autoevaluaciones Ingresadas</b></td>
        <td><b>Meta mensual</b></td>
    </tr> 
   </thead>
   <tbody>
       <tr>
        <td style="background-color: #E0E6F8;"><b><?php echo $nombreJV2; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $reunionDiariaJV2; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $metaDiariaJV2; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $reunionMensualJV2; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $metaMensualJV2; ?></b></td>
       </tr>
     <?php foreach($tabla2 as $data2){ ?>
       <tr>
        <?php echo $data2; ?>
       </tr>
    <?php } ?>
    </tbody> 
</table>
<br>
<h4>Resumen Adolfo Gomez</h4>
<table class="table table-striped" border="1"> 
    <thead>
    <tr>
        <td><b>Nombre</b></td>
        <td><b>Autoevaluaciones diarias</b></td>
        <td><b>Meta diaria</b></td>
        <td><b>Autoevaluaciones Ingresadas</b></td>
        <td><b>Meta mensual</b></td>
    </tr> 
   </thead>
   <tbody>
       <tr>
        <td style="background-color: #E0E6F8;"><b><?php echo $nombreJV3; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $reunionDiariaJV3; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $metaDiariaJV3; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $reunionMensualJV3; ?></b></td>
        <td style="background-color: #E0E6F8;"><b><?php echo $metaMensualJV3; ?></b></td>
       </tr>
     <?php foreach($tabla3 as $data3){ ?>
       <tr>
        <?php echo $data3; ?>
       </tr>
    <?php } ?>
    </tbody> 
</table>
<br>


<?php } ?>