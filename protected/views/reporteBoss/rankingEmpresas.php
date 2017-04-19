 <h3>Ranking mensual de empresas <?php if(isset($mes)){ echo "mes de $mesLetras"; }?></h3>
         <div class="alert alert-success">
             <p>Seleccione un mes para que se muestre el ranking de empresas.</p>
             <?php
                if(isset($mes)){  
                echo CHtml::link('Descargar en Excel',array('ReporteBoss/rankingEmpresas','excel'=>'1','mes'=>$mes),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary'));
                }
                ?>
         </div>
<div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('reporteBoss/rankingEmpresas', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('reporteBoss/rankingEmpresas', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('reporteBoss/rankingEmpresas', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('reporteBoss/rankingEmpresas', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('reporteBoss/rankingEmpresas', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('reporteBoss/rankingEmpresas', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('reporteBoss/rankingEmpresas', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('reporteBoss/rankingEmpresas', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('reporteBoss/rankingEmpresas', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('reporteBoss/rankingEmpresas', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('reporteBoss/rankingEmpresas', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('reporteBoss/rankingEmpresas', 'mes'=>"12")); ?> </strong></div>
</div> 

<?php if(isset($empresas)){ ?>

<script>
$(document).ready(function() {
    $('#tablaRankingEmpresas').dataTable({
        
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
        
    });
} );
</script>

<table class="display" id="tablaRankingEmpresas" cellpadding="0" cellspacing="0"> 
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
    <?php
 
    ?>
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

      <?php
         echo CHtml::button('Volver', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        ); 
      ?>
         


               
    

    



