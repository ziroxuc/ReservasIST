<?php
/* @var $this SegurosController */
/* @var $model Seguros */

$this->breadcrumbs=array(
	'Seguros'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	
	array('label'=>'Crear Seguros', 'url'=>array('create')),
        array('label'=>'Crear Seguros derivados', 'url'=>array('createDerivado')),
        
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seguros-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Seguros
 <?php  
  if(Yii::app()->user->getState("tipo")==="administrador"){
      
   echo CHtml::button('Descargar en excel', array('submit' => array('seguros/segurosExcel'),'style'=>'float:right;','class'=>'btn btn-success')); 
  } 
     ?>
</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seguros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'numero_certificado',
		'rut_ejecutivo',
                'nombre_ejecutivo',
                'fecha_ingreso',
                'plan',
                'inicio_cobranza',
                'nombre_empresa',
                'rut_empresa',
                'digito_empresa',
                'estado',
		/*
                'id',
		'rut_jv',
		'nombre_jv',
		'rut_sup',
		'nombre_sup',
		
		
		'fecha_vigencia',
		
		'nombre',
		'rut',
		'digito',
		'fecha_nacimiento',
		'sexo',
		'direccion',
		'comuna',
		'region',
		'fono_particular',
		'celular',
		'email',
		'producto',
		
		'odonto_individual',
		'odonto_familiar',
		'renta_mensual',
		'interven_quirurgicas',
		'prima_mensual_uf',
		
		'via_pago',
		'banco',
		'nombre_banco',
		'num_cta_corriente',
		'num_tarjeta',
		'codigo_sucursal',
		
		
		
		'contacto_empresa',
		'direccion_empresa',
		'telefono_empresa',
		
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
