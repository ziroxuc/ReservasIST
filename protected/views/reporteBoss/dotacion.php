<script>
$(document).ready(function() {
    $('#tablaDotacion').dataTable({
        "language": {
            "lengthMenu": "_MENU_",
            "zeroRecords": "No se encuentran datos.",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No existen datos.",
            "infoFiltered": "(Filtro de un total de _MAX_ registros)",
            "search":"Buscar",
              paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Anterior"
        },
            
        }
        
    }
            
                );
} );
</script>
      <div class="page-header">
<?php if(!is_null($tabla)){ ?>
          <h4>Resumen dotación</h4>    
          <table border="1" class="table table-striped">
              <tr>
                  <td><b>Jefes de venta</b></td>
                  <td><b>Cantidad supervisores</b></td>
                  <td><b>Cantidad ejecutivos</b></td>
              </tr>
              <tr>
                  <?php foreach($tabla as $data){
                      echo $data;
                  }?>
                  
              </tr>    
          </table>    
<?php } ?>              
     
      </div>

      <h3>Dotación de Gerencia</h3>
         <div class="alert alert-success">
             <p>A continuación se muestra toda la dotación actualizada perteneciente a la Gerencia de adherentes Pyme.</p>
         </div>
         
         <?php
    
    ?>         
<table class="display" id="tablaDotacion"> 
    <thead>
    <tr>
        <td><b>Rut</b></td>
        <td><b>Nombre</b></td>
        <td><b>Apellido</b></td>
        <td><b>Telefono</b></td>
        <td><b>Dirección</b></td>
        <td><b>Fecha de ingreso</b></td>
        <td><b>Fecha de salida</b></td>
        <td><b>Estado</b></td>
        <td><b>Tipo</b></td>
        <td><b>Dependencia</b></td>
    </tr> 
    </thead>
    <?php
 
    ?>
   <tbody> 
     <?php 
     $jerarquia= new Usuario();
     
     foreach($dotacion as $data){ ?>
    <tr>
        <td style="width: 11%;"><?php echo $data['rut']; ?></td>
        <td><?php echo $data['nombre']; ?></td>
        <td style="width: 15%;"><?php echo $data['apellido']; ?></td>
        <td><?php echo $data['telefono']; ?></td>
        <td><?php echo $data['direccion']; ?></td>
        <td><?php echo $data['fecha_ingreso']; ?></td>
        <td><?php echo $data['fecha_salida']; ?></td>
        <td><?php echo $data['estado']; ?></td>
        <td><?php echo $data['tipo']; ?></td>
        <td><?php echo $jerarquia->getNombreDependencia($data['rut_padre']);?></td>
    </tr>
    <?php } ?>
    </tbody> 
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
         


               
    

    



