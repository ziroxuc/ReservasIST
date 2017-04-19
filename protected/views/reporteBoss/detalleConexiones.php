
      <div class="page-header">

        <p class="lead">
         Detalle de conexiones por usuario.
        </p>
      </div>
<?php if(isset($tabla)){?>
      <h3>Tabla detalle de conexiones Jefes de venta</h3>
         <div class="alert alert-success">
             <p>A continuación se muestra el detalle de conexiones de los jefes de venta.</p>
         </div>
         <?php
    ?>         
<table border="1" class="table table-striped"> 
    <tr>
        <td><b>Nombre Jefe de venta</b></td>
        <td><b>Rut Jefe de venta</b></td>
        <td><b>Ultima conexión</b></td>
        <td><b>Cantidad de conexiones</b></td>
        
    </tr> 
    <?php foreach($tabla as $detalle){  
            echo $detalle; 
    }?>
</table>
      
  <?php } ?>    
      <h3>Tabla detalle de conexiones Supervisores</h3>
         <div class="alert alert-success">
             <p>A continuación se muestra el detalle de conexiones de los Supervisores.</p>
         </div>
         <?php
    ?>         
<table border="1" class="table table-striped"> 
    <tr>
        <td><b>Nombre Supervisor</b></td>
        <td><b>Rut Supervisor</b></td>
        <td><b>Ultima conexión</b></td>
        <td><b>Cantidad de conexiones</b></td>
        
    </tr> 
    <?php foreach($tablaSup as $detalle1){  
            echo $detalle1; 
    }?>
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
         


               
    

    



