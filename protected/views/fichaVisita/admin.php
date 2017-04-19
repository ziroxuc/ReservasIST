<?php
/* @var $this FichaVisitaController */
/* @var $model FichaVisita */

$this->breadcrumbs=array(
	'Autoevaluaciones'=>array('admin'),
	'Registro de Autoevaluaciones',
);
if(Yii::app()->user->getState("tipo")==="supervisor"||Yii::app()->user->getState("tipo")==="administrador"){
$this->menu=array(
	
	array('label'=>'Crear nueva Autoevaluación', 'url'=>array('create')),
        array('label'=>'Volver', 'url'=>array('reporteBoss/index')),
);
}else{
 $this->menu=array(
	
	array('label'=>'Volver', 'url'=>array('reporteBoss/index')),
);   
    
}
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ficha-visita-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
   
             
<?php echo CHtml::link('Descargar Excel', array('fichaVisita/datosExcel'),array('style'=>'float:right; margin-top:8px;','class'=>'btn btn-success'));?>
         
     
<?php if(Yii::app()->user->getState('tipo')==="gerente"|| Yii::app()->user->getState('tipo')=="administrador"){ ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ficha-visita-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'nombre_jv',
		'nombre_sup',
		'nombre_eje',
		'rut_empresa',
		'nombre_empresa',
                'cantidad_trab',
		'comuna_empresa',
		'fecha_visita',
                'fech_vencimiento',
                'fech_pos_cierre',
                'total_cumple',
                'total_nocumple',
                'total_noaplica',
                'estado',
                'comentario',      	

		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
}else{
?>
<?php if(Yii::app()->user->getState('tipo')=="supervisor"){?>
<div class="form-group" style="position: relative; margin-left: 120px; padding: 20px; font-size: 16px;">
    <?php echo CHtml::link('Enero', array('fichaVisita/admin', 'mes'=>"01")); ?> | 
    <?php echo CHtml::link('Febrero', array('fichaVisita/admin', 'mes'=>"02")); ?> | 
    <?php echo CHtml::link('Marzo', array('fichaVisita/admin', 'mes'=>"03")); ?> | 
    <?php echo CHtml::link('Abril', array('fichaVisita/admin', 'mes'=>"04")); ?> | 
    <?php echo CHtml::link('Mayo', array('fichaVisita/admin', 'mes'=>"05")); ?> | 
    <?php echo CHtml::link('Junio', array('fichaVisita/admin', 'mes'=>"06")); ?> | 
    <?php echo CHtml::link('Julio', array('fichaVisita/admin', 'mes'=>"07")); ?> | 
    <?php echo CHtml::link('Agosto', array('fichaVisita/admin', 'mes'=>"08")); ?> | 
    <?php echo CHtml::link('Septiembre', array('fichaVisita/admin', 'mes'=>"09")); ?> | 
    <?php echo CHtml::link('Octubre', array('fichaVisita/admin', 'mes'=>"10")); ?> | 
    <?php echo CHtml::link('Noviembre', array('fichaVisita/admin', 'mes'=>"11")); ?> | 
    <?php echo CHtml::link('Diciembre', array('fichaVisita/admin', 'mes'=>"12")); ?>  
  </div>
<?php }else{ ?>

<div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('fichaVisita/admin', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('fichaVisita/admin', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('fichaVisita/admin', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('fichaVisita/admin', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('fichaVisita/admin', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('fichaVisita/admin', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('fichaVisita/admin', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('fichaVisita/admin', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('fichaVisita/admin', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('fichaVisita/admin', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('fichaVisita/admin', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('fichaVisita/admin', 'mes'=>"12")); ?> </strong></div>
</div> 
<?php }?>
<?php if(isset($registros)){?>
<script>
$(document).ready(function() {
      
    $('#tablaDotacion').dataTable({
        
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
		"aaSorting": [[ 6, 'desc' ]],
                
                 
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

      <h4>Registro de Autoevaluaciónes mes de <?php if(isset($mesConv)){echo $mesConv; }?></h4>
         <div class="alert alert-success">
             <p>A continuación se muestran todos sus registros de Autoevaluaciónes.</p>
             <?php echo CHtml::link('Descargar Excel', array('fichaVisita/admin', 'excel'=>"01",'mes'=>$mes),array('style'=>'float:right; margin-top:-30px;','class'=>'btn btn-success'));?>
         
         </div>
    <?php
    
    ?>         
<table class="display" id="tablaDotacion" width="50%"> 
    <thead>
    <tr>
        <td><b></b></td>
       <?php if(Yii::app()->user->getState('tipo')=="jefe de venta"){?>
        <td><b>Supervisor</b></td>
       <?php } ?>
        <td><b>Ejecutivo</b></td>
        <td><b>Rut empresa</b></td>
        <td><b>Nombre empresa</b></td>
        <td><b>cant trabaj</b></td>
        <td><b>Comuna empresa</b></td>
        <td><b>Fecha posible cierre</b></td>
        <td><b>Fecha de vencimiento</b></td>
        <td><b>Estado</b></td>
        <td><b>Cometario</b></td>
        <td><b>C</b></td>
        <td><b>N/C</b></td>
        <td><b>N/A</b></td>
       
    </tr> 
    </thead>
    <?php
 
    ?>
   <tbody> 
     <?php 
     $x = new FichaVisita();
     foreach($registros as $data){ ?>
    <tr>
        <td><b></b></td>
       <?php if(Yii::app()->user->getState('tipo')=="jefe de venta"){?>
         <td><?php echo $data['nombre_sup']; ?></td>
       <?php } ?>
        <td><?php echo $data['nombre_eje']; ?></td>
        <td><?php echo $data['rut_empresa']; ?></td>
        <td><?php echo CHtml::link($data['nombre_empresa'], array('fichaVisita/view', 'id'=>$data['id']),array('style'=>'color:blue;')); ?> </td>
        <td><?php echo $data['cantidad_trab']; ?></td>
        <td><?php echo $data['comuna_empresa']; ?></td>
        <td><?php echo $data['fech_pos_cierre']; ?></td>
        <td><?php echo $data['fech_vencimiento']; ?></td>
        <td><?php echo $data['estado']; ?></td>
        <td><?php echo $x->recortar_texto($data['comentario'], 40); ?></td>
        <td><?php echo $data['total_cumple']; ?></td>
        <td><?php echo $data['total_nocumple']; ?></td>
        <td><?php echo $data['total_noaplica']; ?></td>
        
    </tr>
    <?php } ?>
    </tbody> 
</table>
      
<?php } 
}?>