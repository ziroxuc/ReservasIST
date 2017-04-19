<table border="1"> 
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