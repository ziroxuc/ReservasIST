
      <div class="page-header">

        <p class="lead">
         Resultado de la busqueda
        </p>
      </div>

      <h3>Tabla detalle de Busqueda</h3>
         <div class="alert alert-success">
             <p>A continuación se muestra el detalle de las solicitudes del ejecutivo.</p>
         </div>
         <?php
    ?>         
<table border="1" class="table table-striped"> 
    <tr>
        <td><b>Nombre supervisor</b></td>
        <td><b>Nombre jefe de venta</b></td>
        <td><b>Nombre ejecutivo</b></td>
        <td><b>Nombre de empresa</b></td>
        <td><b>Rut de empresa</b></td>
        <td><b>Número de trabajadores</b></td>
        <td><b>Fecha de validación</b></td>
        <td><b>Fecha vigencia</b></td>
        <td><b>Estado de solicitud</b></td>
        <td colspan="2"><b>Comentario</b></td>
    </tr> 
    <?php
        if($result==true){
    ?>
     <?php foreach($consulta as $detalle){ ?>   
    <tr>
        <td><?php echo $detalle['nombre_jv']; ?></td>
        <td><?php echo $detalle['nombre_sup']; ?></td>
        <td><?php echo $detalle['nombre_ejecutivo']; ?></td>
        <td><?php echo $detalle['nombre_empresa']; ?></td>
        <td><?php echo $detalle['rut_empresa']; ?></td>
        <td><?php echo $detalle['cantidad_trabajadores']; ?></td>
        <td><?php echo $detalle['fecha_cambio_estado']; ?></td>
        <td><?php echo $detalle['vigencia']; ?></td>
        <td><?php echo $detalle['estado']; ?></td>
        <td><?php echo $detalle['comentario']; ?></td>
    </tr>
     <?php }
     }else{
         ?>
    <tr>
         <div class="alert alert-danger">
             <strong>No hay resultados para el rut <?php echo $rut;?>.</strong>
         </div>
    </tr>
         <?php
     }
      ?>
</table>
      <?php
      echo CHtml::link(CHtml::encode('Salir y cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-danger','style'=>'float:right',));
      echo CHtml::button('Volver', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        ); 
      ?>
         


               
    

    



