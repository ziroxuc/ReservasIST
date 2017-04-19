<?php //if(isset($tablaResumenJV)){?>
<!--<h4>Resumen total de solicitudes vencidas por jefe de venta</h4>
<table id="tablaDetalleDevueltass" border="1" class="table table-striped"> 
    <thead>
      <tr>
          <td><b>Jefe de venta</b></td>
          <td><b>Cantidad Solicitudes vencidas</b></td>
          <td><b>Cantidad Adherentes vencidos</b></td>
      </tr> 
    </thead>
    <tbody> -->
   <?php //foreach($tablaResumenJV as $data){ ?>
       <?php //echo $data; ?> 
   <?php //}?>
          
<!--    </tbody> 
</table>-->
<?php //}?>


<?php if(isset($tablasSupFCO)){?>
<h4>FRANCISCO DÍAZ Detalle supervisores </h4>
<table  border="1" class="table table-striped"> 
    <thead>
      <tr>
          <td><b>Supervisor</b></td>
          <td><b>Estado</b></td>
          <td><b>Cantidad Solicitudes vencidas</b></td>
          <td><b>Cantidad Adherentes vencidos</b></td>
      </tr> 
    </thead>
    <tbody> 
    <?php foreach($tablasSupFCO as $datafco){ ?>
       <?php echo $datafco; ?> 
   <?php }?> 
    </tbody> 
</table><?php }?>


<?php if(isset($tablasSupEMM)){?>
<h4>EMMANUEL SEGURA Detalle supervisores </h4>
<table  border="1" class="table table-striped"> 
    <thead>
      <tr>
          <td><b>Supervisor</b></td>
          <td><b>Estado</b></td>
          <td><b>Cantidad Solicitudes vencidas</b></td>
          <td><b>Cantidad Adherentes vencidos</b></td>
      </tr> 
    </thead>
    <tbody> 
    <?php foreach($tablasSupEMM as $dataemm){ ?>
       <?php echo $dataemm; ?> 
   <?php }?> 
    </tbody> 
</table><?php }?>



<?php if(isset($tablasSupADOL)){?>
<h4>ADOLFO GOMEZ Detalle supervisores </h4>
<table border="1" class="table table-striped"> 
    <thead>
      <tr>
          <td><b>Supervisor</b></td>
          <td><b>Estado</b></td>
          <td><b>Cantidad Solicitudes vencidas</b></td>
          <td><b>Cantidad Adherentes vencidos</b></td>
      </tr> 
    </thead>
    <tbody> 
    <?php foreach($tablasSupADOL as $dataadol){ ?>
       <?php echo $dataadol; ?> 
   <?php }?> 
    </tbody> 
</table><?php }?>




<?php if(isset($devueltas)){?>
<script>
$(document).ready(function() {
    $('#tablaDetalleDevueltas').dataTable({
        "fnDrawCallback": function ( oSettings ) {
			/* Need to redo the counters if filtered or sorted */
			if ( oSettings.bSorted || oSettings.bFiltered )
			{
				for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
				{
					$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
				}
			}
		},
		"aoColumnDefs": [
			{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[ 7, 'asc' ]],
        
        
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


      <h3>Detalle solicitudes vencidas</h3>
       
         <?php
    ?>         
      <table id="tablaDetalleDevueltas" class="display"> 
          <thead>
            <tr>
                <td><b>Número</b></td>
                <td><b>Jefe de venta</b></td>
                <td><b>Supervisor</b></td>
                <td><b>Ejecutivo</b></td>
                <td><b>Nombre empresa</b></td>
                <td><b>Rut empresa</b></td>
                <td><b>Cantidad Trabajadores</b></td>
                <td><b>Fecha validación</b></td>
                <td><b>Estado</b></td>
            </tr> 
        </thead>
        <tbody> 
    <?php foreach($devueltas as $detalle){ ?>
    <tr>
        <td style="width: 1px;"></td>
        <td><?php echo $detalle['nombre_jv']; ?> </td>
        <td><?php echo $detalle['nombre_sup']; ?> </td>
        <td><?php echo $detalle['nombre_ejecutivo']; ?> </td>
        <td><?php echo $detalle['nombre_empresa']; ?> </td>
        <td style="width: 10%;"><?php echo $detalle['rut_empresa']; ?> </td>
        <td style="text-align: center;"><?php echo $detalle['cantidad_trabajadores']; ?> </td>
        <td><?php echo $detalle['fecha_cambio_estado']; ?> </td>
        <td><?php echo $detalle['estado']; ?> </td>
    </tr>    
            
   <?php }?>
    </tbody> 
</table>
      
  <?php } ?>           
      <?php
       echo CHtml::button('Volver', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        ); 
      ?>
         


               
    

    



