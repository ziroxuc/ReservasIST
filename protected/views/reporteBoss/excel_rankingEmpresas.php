 <h3>Ranking mensual de empresas <?php if(isset($mes)){ echo "mes de $mesLetras"; }?></h3>

<?php if(isset($empresas)){ ?>

<table class="display" id="tablaRankingEmpresas" cellpadding="0" cellspacing="0" border="1"> 
    <thead>
    <tr>
        <th><b>Posición</b></th>
        <th><b>Jefe de venta</b></th>
        <th><b>Supervisor</b></th>
        <th><b>Ejecutivo</b></th>
        <th><b>Rut empresa</b></th>
        <th><b>Nombre empresa</b></th>
        <th><b>Trabajadores</b></th>
        <th><b>Estado</b></th>
    </tr> 
    </thead>

   <tbody> 
      <?php foreach($empresas as $data){?>
       <tr>
            <td></td>
            <td><?php echo $data['nombre_jv']; ?></td>
            <td><?php echo $data['nombre_sup']; ?></td>
            <td><?php echo $data['nombre_ejecutivo']; ?></td>
            <td><?php echo $data['rut_empresa']; ?></td>
            <td><?php echo $data['nombre_empresa']; ?></td>
            <td><?php echo $data['cantidad_trabajadores']; ?></td>
            <td><?php echo $data['estado']; ?></td> 
       </tr>
            <?php } ?>
    </tbody> 
</table>

<?php  } ?>
         


               
    

    



