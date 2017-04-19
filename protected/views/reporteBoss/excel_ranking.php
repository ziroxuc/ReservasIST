
<h3>Ranking de ejecutivos</h3>

<table border="1" >
    <tr>
        <td style="text-align: center"><b></b></td>
        <td style="text-align: center"><b>Jefe de venta</b></td>
        <td style="text-align: center"><b>Supervisor</b></td>
        <td style="text-align: center"><b>Ejecutivo</b></td>
        <td style="text-align: center"><b>Rut ejecutivo</b></td>
        <td style="text-align: center"><b>Contratos</b></td>
        <td style="text-align: center"><b>Trabajadores</b></td>
        <td style="text-align: center"><b>Meses trabajados</b></td>
        <td style="text-align: center"><b>Promedio por mes</b></td>
    </tr> 
   
   <?php
   foreach ($tabla as $datos){?> 
     <tr>
        <?php  echo $datos; ?>  
    </tr> 
   <?php } ?>
</table>



