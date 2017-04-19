<h4>Autoevaluaciones</h4>
<?php

if($registros!==null){ ?>
<table border="1"> 
    <thead>
    <tr>
        <td><b>Jefe de venta</b></td>
        <td><b>Supervisor</b></td>
        <td><b>Ejecutivo</b></td>
        <td><b>Rut empresa</b></td>
        <td><b>Nombre empresa</b></td>
        <td><b>cant trabaj</b></td>
        <td><b>Direccion</b></td>>
        <td><b>Comuna empresa</b></td>
        <td><b>Contacto</b></td>
        <td><b>Fecha de la visita</b></td>
        <td><b>Fecha de ingreso</b></td>
        <td><b>Usuario web</b></td>
        <td><b>Fecha posible cierre</b></td>
        <td><b>Fecha de vencimiento</b></td>
        <td><b>Estado</b></td>
        <td><b>Cometario</b></td>
        <td><b>C</b></td>
        <td><b>N/C</b></td>
        <td><b>N/A</b></td>
        <td><b>GTL1</b></td>
        <td><b>GTL2</b></td>
        <td><b>GTL3</b></td>
        <td><b>GTL4</b></td>
        <td><b>GTL5</b></td>
        <td><b>GTL6</b></td>
        <td><b>GTL7</b></td>
        <td><b>GTL8</b></td>
        <td><b>GTL9</b></td>
    </tr> 
   </thead>
   <tbody>
         <?php
     foreach($registros as $data){ ?>
    <tr>
        <td><?php echo $data['nombre_jv']; ?></td>
        <td><?php echo $data['nombre_sup']; ?></td>
        <td><?php echo $data['nombre_eje']; ?></td>
        <td><?php echo $data['rut_empresa']; ?></td>
        <td><?php echo $data['nombre_empresa']; ?> </td>
        <td><?php echo $data['cantidad_trab']; ?></td>
        <td><?php echo $data['direccion_empresa']; ?></td>
        <td><?php echo $data['comuna_empresa']; ?></td>
        <td><?php echo $data['nombre_contacto']; ?></td>
        <td><?php echo $data['fecha_visita']; ?></td>
        <td><?php echo $data['fecha_ingreso']; ?></td>
        <td><?php echo $data['usuario_web']; ?></td>
        <td><?php echo $data['fech_pos_cierre']; ?></td>
        <td><?php echo $data['fech_vencimiento']; ?></td>
        <td><?php echo $data['estado']; ?></td>
        <td><?php echo $data['comentario']; ?></td>
        <td><?php echo $data['total_cumple']; ?></td>
        <td><?php echo $data['total_nocumple']; ?></td>
        <td><?php echo $data['total_noaplica']; ?></td>
        <td><?php echo $data['GTL1']; ?></td>
        <td><?php echo $data['GTL2']; ?></td>
        <td><?php echo $data['GTL3']; ?></td>
        <td><?php echo $data['GTL4']; ?></td>
        <td><?php echo $data['GTL5']; ?></td>
        <td><?php echo $data['GTL6']; ?></td>
        <td><?php echo $data['GTL7']; ?></td>
        <td><?php echo $data['GTL8']; ?></td>
        <td><?php echo $data['GTL9']; ?></td>

    </tr>
    <?php } ?>
    </tbody> 
</table>
<?php } ?>


