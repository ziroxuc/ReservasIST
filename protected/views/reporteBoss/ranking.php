<script>
$(document).ready(function() {
    $('#tablaRanking').dataTable({
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
		"aaSorting": [[ 5, 'desc' ]],
        
        
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
    

      <h3>Ranking de ejecutivos</h3>
         <div class="alert alert-success">
             <p>A continuación se muestran todos los ejecutivos con la cantidad total de contratos y trabajadores.</p>
             <?php 
                echo CHtml::link('Descargar en Excel',array('ReporteBoss/ranking','excel'=>'1'),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary'));
             ?>
         </div>
         
         <?php
    
    ?>         
<table class="display" id="tablaRanking" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr>
        <th><b>Posición</b></th>
        <th><b>Jefe de venta</b></th>
        <th><b>Supervisor</b></th>
        <th><b>Ejecutivo</b></th>
        <th><b>Rut ejecutivo</b></th>
        <th><b>Contratos</b></th>
        <th><b>Trabajadores</b></th>
        <th><b>Meses trabajados</b></th>
        <th><b>Promedio por mes</b></th>
    </tr> 
    </thead>
    <?php
 
    ?>
   <tbody> 
     <?php
     
     foreach($tabla as $data){ ?>
    <tr>
        <?php echo $data; ?>
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
         


               
    

    



