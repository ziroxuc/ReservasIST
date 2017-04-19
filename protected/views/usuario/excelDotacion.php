<h4>Dotacion</h4>
<?php

if($usuario!==null){ ?>
<table border="1"> 
    <thead>
    <tr>
        <td><b>Rut</b></td>
        <td><b>Nombre</b></td>
        <td><b>Apellido</b></td>
        <td><b>Fecha de inicio contrato</b></td>
        <td><b>Fecha termino contrato</b></td>
        <td><b>Tipo de usuario</b></td>
        <td><b>Estado</b></td>
        <td><b>Dependencia</b></td>
    </tr> 
   </thead>
   <tbody>
       
     <?php foreach($usuario as $data){ ?>
       <tr>
           <td><?php echo $data['rut']; ?></td>
           <td><?php echo $data['nombre']; ?></td>
           <td><?php echo $data['apellido']; ?></td>
           <td><?php echo $data['fecha_ingreso']; ?></td>
           <td><?php echo $data['fecha_salida']; ?></td>
           <td><?php echo $data['tipo']; ?></td>
           <td><?php echo $data['estado']; ?></td>
           <td><?php echo $data['rut_padre']; ?></td>
        </tr>
    <?php } ?>
      
    </tbody> 
</table>
<?php } ?>


