<?php

if($modelfech!==null){ ?>
<table border="1" >
    <tr>
        <td><b>Nombre Jefe de venta</b></td>
        <td><b>Rut Jefe de venta</b></td>
        <td><b>Nombre Supervisor</b></td>
        <td><b>Rut Supervisor</b></td>
        <td><b>Nombre ejecutivo</b></td>
        <td><b>Rut ejecutivo</b></td>
        <td><b>Nombre empresa</b></td>
        <td><b>Rut empresa</b></td>
        <td><b>Telefono</b></td>
        <td><b>Codigo Actividad</b></td>
        <td><b>Tipo Contrato</b></td>
        <td><b>Fecha de ingreso</b></td>
        <td><b>Fecha de validacion</b></td>
        <td><b>Nombre de contacto</b></td>
        <td><b>Cantidad de trabajadores</b></td>
        <td><b>Procedencia</b></td>
        <td><b>Vigencia</b></td>
        <td><b>Fecha de Solicitud</b></td>
        <td><b>Estado</b></td>
        <td><b>Comentario</b></td>
    </tr>    
   <?php
   foreach ($modelfech as $datos){?> 
     <tr>
        <td><?php  echo $datos["nombre_jv"]; ?></td>
        <td><?php  echo $datos["rut_jv"]; ?></td>
        <td><?php  echo $datos["nombre_sup"]; ?></td>
        <td><?php  echo $datos["rut_sup"]; ?></td>
        <td><?php  echo $datos["nombre_ejecutivo"]; ?></td>
        <td><?php  echo $datos["rut_ejecutivo"];?></td>
        <td><?php  echo $datos["nombre_empresa"];?></td>
        <td><?php  echo $datos["rut_empresa"]; ?></td>
        <td><?php  echo $datos["telefono_contacto_emp"]; ?></td>
        <td><?php  echo $datos["codigo_actividad"]; ?></td>
        <td><?php  echo $datos["tipo_contrato"]; ?></td>
        <td><?php  echo $datos["fecha_ingreso"]; ?></td>
        <td><?php  echo $datos["fecha_cambio_estado"]; ?></td>
        <td><?php  echo $datos["nombre_contacto_emp"]; ?></td>
        <td><?php  echo $datos["cantidad_trabajadores"]; ?></td>
        <td><?php  echo $datos["origen_emp"];?></td>
        <td><?php  echo $datos["vigencia"];?></td>
        <td><?php  echo $datos["fecha_solicitud"];?></td>
        <td><?php  echo $datos["estado"]; ?></td>
        <td><?php  echo $datos["comentario"];?></td>
    </tr> 
   <?php } ?>
</table>
<?php } ?>


