<?php

if($memo!==null){?>

<h3> MEMO <?php echo $memo; ?></h3>

<table border="1">
    <tr>
        <td><b>Fecha de solicitud</b></td>
        <td><b>Tipo de contrato</b></td>
        <td><b>Rut Empresa </b></td>
        <td><b>Nombre empresa </b></td>
        <td><b>Ejecutivo</b></td>
        <td><b>Vigencia</b></td>
    </tr>
    
    <?php foreach ($datosMemo as $data){?>
    <tr>
        <td><?php echo $data['fecha_solicitud']; ?></td>
        <td><?php echo $data['tipo_contrato']; ?></td>
        <td><?php echo $data['rut_empresa']; ?></td>
        <td><?php echo $data['nombre_empresa']; ?></td>
        <td><?php echo $data['nombre_ejecutivo']; ?></td>
        <td><?php echo $data['vigencia']; ?></td>
    </tr>
    <?php } ?>
</table>    



<?php } ?>


