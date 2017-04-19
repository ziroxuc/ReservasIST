<?php

if($TotalCompletas!==null){ 
    date_default_timezone_set('UTC');
    ?>

<h2>Reporte total de solicitudes hasta la fecha <?php echo date("d/m/Y"); ?></h2>
<table border="1" >
    <tr>
        <td><b>Estado</b></td>
        <td><b>Cantidad total de empresas</b></td>
        <td><b>Cantidad total de trabajadores</b></td>
    
    </tr>    
   <?php
   //foreach ($model as $datos){?> 
     <tr>   
        <td>Completas</td>
        <td><?php  echo $TotalCompletas ?></td>
        <td><?php  echo $SumaCompletas ?></td>
    </tr> 
     <tr>
        <td>Incompletas</td>
        <td><?php  echo $TotalIncompletas ?></td>
        <td><?php  echo $SumaIncompletas ?></td>
  
    </tr> 
     <tr>
        <td>En revision</td>
        <td><?php  echo $TotalIngresadas ?></td>
        <td><?php  echo $SumaIngresadas ?></td>
    </tr> 
    <tr>
        <td bgcolor="#82FA58"><b>Total General</b></td>
        <td bgcolor="#82FA58"><br><?php  echo $TotGeneralEmpresas ?></br></td>
        <td bgcolor="#82FA58"><br><?php  echo $totGeneralTrab ?></br></td>
    </tr> 
   <?php //} ?>
</table>
 
<?php } ?>


