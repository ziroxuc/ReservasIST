<script>
$(document).ready(function() {
    $('#tablaBonos').dataTable({
        "language": {
            "lengthMenu": "_MENU_",
            "zeroRecords": "No se encuentran datos.",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No existen datos.",
            "infoFiltered": "(Filtro de un total de _MAX_ registros)",
            "search":"Buscar",
              paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Anterior"
        },
            
        }
        
    }
            
                );
} );
</script>
<h3>Tabla de Bonos </h3>
<div style="height: 10px;"> </div>
<?php
 echo CHtml::link('Descargar en Excel',array('bonos/generarBonos','excel'=>'1','fecha1'=>$fecha1,'fecha2'=>$fecha2),array('style'=>'float:right;margin-top:-50px;','class'=>'btn btn-success'));    
 date_default_timezone_set('UTC');

 ?>
 <div class="alert alert-success">
     <p>A continuación se muestran los bonos de los ejecutivos para el mes de <?php $a=new Bonos(); echo $a->getMes($fecha2)." del ".date('Y');?>.</p>
</div>


<?php
$this->menu=array(
	
	array('label'=>'Volver', 'url'=>array('bonos/index')),
);
?>
<div style="height: 10px;">
    
</div>
<table class="display" id="tablaBonos"> 
    <thead>
    <tr>
        <td><b>Jefe de venta</b></td>
        <td><b>Supervisor</b></td>
        <td><b>Ejecutivo</b></td>
        <td><b>Rut Ejecutivo</b></td>
        <td><b>Fecha de contrato</b></td>
        <td><b>Meses trabajados</b></td>
        <td><b>Contratos devueltos</b></td>
        <td><b>Contratos Completos</b></td>
        <td><b>Cantidad de trabajadores</b></td>
        <td><b>Meta</b></td>
        <td><b>Bono(pesos)</b></td>
    </tr>  
    </thead>
  
     <tbody> 
<?php
foreach($table as $detalle){
    ?>  <tr style="text-align: center;">  
    <?php echo $detalle; ?> 
    </tr>
        <?php
        }
?>
   </tbody> 
</table>