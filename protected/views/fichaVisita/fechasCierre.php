<script>
$(document).ready(function() {
    $('#tablaVisitas').dataTable({
        
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
		
        
        
         "processing": true,
         //"serverSide": true,
         
        "ajax": {
            "url":  "http://localhost:81/yii/Ist_reservas/fichaVisita/alertasJSON",
            "type": "POST"
        },
        
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

<h3>Autoevaluaciones por cerrar</h3>
<div style="height: 10px;"> </div>
<?php
if(Yii::app()->user->getState("tipo")==="supervisor"||Yii::app()->user->getState("tipo")==="administrador"){
$this->menu=array(
	
	array('label'=>'Crear nueva Autoevaluación', 'url'=>array('create')),
        array('label'=>'Ver registro de Autoevaluaciones', 'url'=>array('admin')),
        array('label'=>'Volver', 'url'=>array('reporteBoss/index')),
);
}else{
 $this->menu=array(
	
	array('label'=>'Volver', 'url'=>array('reporteBoss/index')),
        array('label'=>'Ver registro de Autoevaluaciones', 'url'=>array('admin')),
);   
    
}
?>
<div style="height: 10px;">
    
</div>
<table class="display" id="tablaVisitas"> 
    <thead>
            <tr>
                <th>nombre_jv</th>
                <th>nombre_sup</th>
                <th>nombre_eje</th>
                <th>nombre_empresa</th>
                <th>rut_empresa</th>
                <th>visita</th>
                <th>fech_pos_cierre</th>
            </tr>
        </thead>
</table>