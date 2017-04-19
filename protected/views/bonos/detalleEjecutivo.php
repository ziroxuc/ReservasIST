<h3>Detalle solicitudes</h3>
<div style="height: 10px;"> </div>

 <div class="alert alert-success">
     <p>A continuación se muestran el detalle de las solicitudes.</p>
</div>
<?php
echo CHtml::link('Volver a Reportes',array('Bonos/generarBonos','fecha1'=>$fecha1,'fecha2'=>$fecha2),array('style'=>'float:right;margin-top:-120px;','class'=>'btn btn-success')); 
  

?>

<?php
$this->menu=array(
	
	array('label'=>'Volver a Inicio', 'url'=>array('bonos/index')),
);
?>
<div style="height: 10px;">
    
</div>
<table border="1" class="table table-striped"> 
    <tr>
        <td><b>Nombre ejecutivo</b></td>
        <td><b>Nombre de empresa</b></td>
        <td><b>Rut de empresa</b></td>
        <td><b>Número de trabajadores</b></td>
        <td><b>Fecha de validación</b></td>
        <td><b>Fecha vigencia</b></td>
        <td><b>Estado de solicitud</b></td>
        <td colspan="2"><b>Comentario</b></td>
    </tr> 
    <?php
 
    ?>
   
     <?php foreach($detalle as $data){ ?>
    <tr>
        <td><?php echo $data['nombre_ejecutivo']; ?></td>
        <td><?php echo $data['nombre_empresa']; ?></td>
        <td><?php echo $data['rut_empresa']; ?></td>
        <td><?php echo $data['cantidad_trabajadores']; ?></td>
        <td><?php echo $data['fecha_cambio_estado']; ?></td>
        <td><?php echo $data['vigencia']; ?></td>
        <td><?php echo $data['estado']; ?></td>
        <td><?php echo $data['comentario']; ?></td>
    </tr>
    <?php } ?>
</table>