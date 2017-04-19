<h4>Dependencias</h4>
<?php

if($dependencias!==null){ ?>
<table border="1"> 
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


