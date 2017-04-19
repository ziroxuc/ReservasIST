
      <div class="page-header">

        <p class="lead">
            <?php if(isset($month)){ ?> 
            Reporte mes de <?php echo $month?> del <?php 
            }else{
             ?>   
             Reporte para el rango de fechas entre <?php echo $fech1?> y <?php echo $fech2?> del <?php    
            }
            //date_default_timezone_set("America/Santiago");
            date_default_timezone_set('UTC');
            //$hora = time();
            echo date('Y');
            echo " Fecha de emision:";
            echo " ";
            echo date('d/m/Y');
            echo " a las ";
            echo date('H:i');
            echo " hrs.";
            ?>  
        </p>
      </div>

      <h3>Tabla detalle Ejecutivo <?php echo $nombre;?></h3>
         <div class="alert alert-success">
             <p>A continuación se muestra el detalle de las solicitudes del ejecutivo.</p>
         </div>
         
         <?php
    
    ?>         
<table border="1" class="table table-striped"> 
    <tr>
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
 
    ?>
   
     <?php foreach($detalleEjecutivos as $detalle){ ?>
    <tr>
        <td><?php echo $detalle['nombre_ejecutivo']; ?></td>
        <td><?php echo $detalle['nombre_empresa']; ?></td>
        <td><?php echo $detalle['rut_empresa']; ?></td>
        <td><?php echo $detalle['cantidad_trabajadores']; ?></td>
        <td><?php echo $detalle['fecha_cambio_estado']; ?></td>
        <td><?php echo $detalle['vigencia']; ?></td>
        <td><?php echo $detalle['estado']; ?></td>
        <td><?php echo $detalle['comentario']; ?></td>
    </tr>
    <?php } ?>
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
         


               
    

    



