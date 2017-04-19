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

<h3>Detalle de Autoevaluaciones</h3>
<div style="height: 10px;"> 
<?php
echo CHtml::link('< Volver',Yii::app()->request->urlReferrer, array('class'=>'btn btn-primary','style'=>'float:right; margin-top:-30px;'));
?>

</div>
<?php
$this->menu=array(
	
	array('label'=>'Volver', 'url'=>array('FichaVisita/ContarVisitas')),
);
?>
<div style="height: 10px;">
    
</div>
<table class="display" id="tablaVisitas"> 
    <thead>
    <tr>
        <td><b>Jefe de venta</b></td>
        <td><b>Supervisor</b></td>
        <td><b>Ejecutivo</b></td>
        <td><b>Rut Empresa</b></td>
        <td><b>Nombre Empresa</b></td>
        <td><b>Dirección</b></td>
        <td><b>Comuna</b></td>
        <td><b>Fecha de Autoevaluación</b></td>
    
    </tr> 
   </thead>
   <tbody> 
     <?php foreach($detalle as $data){ ?>
    <tr>
        <td><?php echo $data['nombre_jv']; ?></td>
        <td><?php echo $data['nombre_sup']; ?></td>
        <td><?php echo $data['nombre_eje']; ?></td>
        <td><?php echo $data['rut_empresa']; ?></td>
        <td><?php echo CHtml::link($data['nombre_empresa'], array('fichaVisita/detalleEmpresa', 'id'=>$data['id']),array('style'=>'color:blue;')); ?></td>
        <td><?php echo $data['direccion_empresa']; ?></td>
        <td><?php echo $data['comuna_empresa']; ?></td>
        <td><?php echo $data['fecha_visita']; ?></td>
    </tr>
    <?php } ?>
    </tbody> 
</table>