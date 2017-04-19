 <h3>Ranking mensual de ejecutivos <?php if(isset($mes)){ echo "mes de $mesLetras"; }?></h3>
         <div class="alert alert-success">
             <p>Seleccione un mes para que se muestre el ranking de ejecutivos con sus contratos y trabajadores.</p>
             <?php
                if(isset($mes)){  
                echo CHtml::link('Descargar en Excel',array('ReporteBoss/rankingMensual','excel'=>'1','mes'=>$mes),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary'));
                }
                ?>
         </div>
<div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('reporteBoss/RankingMensual', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('reporteBoss/RankingMensual', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('reporteBoss/RankingMensual', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('reporteBoss/RankingMensual', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('reporteBoss/RankingMensual', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('reporteBoss/RankingMensual', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('reporteBoss/RankingMensual', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('reporteBoss/RankingMensual', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('reporteBoss/RankingMensual', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('reporteBoss/RankingMensual', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('reporteBoss/RankingMensual', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('reporteBoss/RankingMensual', 'mes'=>"12")); ?> </strong></div>
</div> 

<?php if(isset($tabla)){ ?>

<script>
$(document).ready(function() {
    $('#tablaRankingMensual').dataTable({
        
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
        
    });
} );
</script>

<table class="display" id="tablaRankingMensual" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr>
        <th><b>Posición</b></th>
        <th><b>Jefe de venta</b></th>
        <th><b>Supervisor</b></th>
        <th><b>Ejecutivo</b></th>
        <th><b>Contratos</b></th>
        <th><b>Trabajadores</b></th>
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

<?php  } ?>

      <?php
      echo CHtml::link(CHtml::encode('Salir y cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-danger','style'=>'float:right',));
      echo CHtml::button('Volver', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        ); 
      ?>
         


               
    

    



