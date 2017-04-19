<script type="text/javascript">
      $(document).ready(function(){
       $("#errorSubmit").hide();
        $("#bonos-form").submit(function () {  
       if($("#Bonos_fecha1").val().length < 1) {  
       $("#errorSubmit").show(); 
           return false;
       }else{
           $("#errorSubmit").hide();
           return true;
       }     
      }); 
}); 
</script>
<h3>Reuniones por ejecutivo <?php if(isset($mes1))echo "mes de ".$mes1;?> </h3>

<div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('fichaVisita/contarVisitas', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('fichaVisita/contarVisitas', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('fichaVisita/contarVisitas', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('fichaVisita/contarVisitas', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('fichaVisita/contarVisitas', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('fichaVisita/contarVisitas', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('fichaVisita/contarVisitas', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('fichaVisita/contarVisitas', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('fichaVisita/contarVisitas', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('fichaVisita/contarVisitas', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('fichaVisita/contarVisitas', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('fichaVisita/contarVisitas', 'mes'=>"12")); ?> </strong></div>
</div> 

<?php if(isset($tabla)){ ?>    
<div class="alert alert-info">
        <p>A continuación se muestra el total de las Autoevaluaciones realizadas por los ejecutivos.</p>
        <?php echo CHtml::link('Descargar Excel', array('fichaVisita/contarVisitas','mes'=>$mes,'excel'=>"01"),array('style'=>'float:right; margin-top:-25px;','class'=>'btn btn-success'));?>
      
</div>

<div class="alert alert-danger" id="errorSubmit">
    <p><b>ERROR:</b> Debe completar todos los campos.</p>
</div>

<br>
<?php if(isset($tabla)){ ?>
<script>
$(document).ready(function() {
    
    $('#tablaConteo').dataTable({
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
		"aaSorting": [[ 4, 'desc' ]],
                
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

       
<table class="display" id="tablaConteo"> 
    <thead>
    <tr>
        <td><b>Posición</b></td>
        <td><b>Jefe de venta</b></td>
        <td><b>Supervisor</b></td>
        <td><b>Ejecutivo</b></td>
        <td><b>Cantidad de Autoevaluaciones</b></td>
        <td><b>Convertidas en solicitud</b></td>
    </tr> 
    </thead>
  
   <tbody> 
     <?php
     
     foreach($tabla as $data){ ?>
    <tr>
        <?php echo $data; ?>
    </tr>
    <?php } ?>
    </tbody> 
</table>

<?php } 
}
?>   

      

         


               
    

    



