<script type="text/javascript">
$(document).ready(function(){

    $('#RutMalo').hide();
    var op=true;
    $('#Buscar_rut').Rut({
      on_error: function(){ 
          op=false;
          $('#RutMalo').show();
        },
      on_success: function(){ 
            op=true; 
            $('#RutMalo').hide();
        },
      format_on: 'keyup' 
      
    });
    $("#ficha-visita-form").submit(function(){
         if(op==true){
            return true;
        }else{
            return false;
        }      
     });
   
});
</script> 

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ficha-visita-form',
        'action'=>'Dependencias',
        'method'=>'get',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false
)); ?>

<h3>Dependencias</h3>

<div style="height: 20px;">

</div>

<div class="row">
    <?php echo $form->labelEx($buscar,'rut'); ?>
    <?php echo $form->textField($buscar,'rut',array('size'=>12,'maxlength'=>13)); ?>
    <?php echo $form->error($buscar,'rut'); ?>
    <div class="alert alert-danger" id="RutMalo" style="width: 120px; float: left; margin-left: 5px; height: 11px;">
                    Rut incorrecto!
    </div>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Buscar'); ?>
</div>
<?php $this->endWidget(); ?>
<?php
$this->menu=array(
	array('label'=>'Volver', 'url'=>array('FichaVisita/ContarVisitas')));
?>
<hr>

<?php if(isset($dependencias)){?>
<?php
echo CHtml::link('Descargar en excel',array('Usuario/dependencias','excel'=>'1','rutF'=>$rutF), array('class'=>'btn btn-primary','style'=>'float:right; margin-top:0px;'));
?>
<h4>Resumen de dependencias</h4>
<div style="height:20px;">
    
</div>

<table class="table table-striped" border="0"> 
    <thead>
    <tr>
        
        <td><b>Nombre usuario</b></td>
        <td><b>Rut usuario</b></td>
        <td><b>Tipo</b></td>
        <td><b>Estado</b></td>
        <td><b>Inicio contrato</b></td>
        <td><b>Termino contrato</b></td>
        <td><b>Inicio dependencia</b></td>
        <td><b>Termino dependencia</b></td>
        <td><b>Jefe de venta</b></td>
        <td><b>Supervisor</b></td>
        <td><b>Usuario modifica</b></td>
        <td><b>fecha modificación</b></td>
    </tr> 
   </thead>
   <tbody>
       
     <?php foreach($dependencias as $data){ ?>
       <tr>
           
           <td><?php echo $data['nombre']; ?></td>
           <td style="width: 10%;"><?php echo $data['rut']; ?></td>
           <td><?php echo $data['tipo']; ?></td>
           <td><?php echo $data['estado']; ?></td>
           <td style="width: 10%;"><?php echo $data['fech_inicio_contr']; ?></td>
           <td><?php echo $data['fech_termino_contr']; ?></td>
           <td><?php echo $data['fech_inicio_depen']; ?></td>
           <td><?php echo $data['fech_termino_depen']; ?></td>
           <td><?php echo $data['dependencia_jv']; ?></td>
           <td><?php echo $data['dependencia_sup']; ?></td>
           <td><?php echo $data['usuario_web_modif']; ?></td>
           <td><?php echo $data['fech_usuario_web_modif']; ?></td>
        </tr>
       
    <?php } ?>
      
    </tbody> 
</table>
<?php } ?>