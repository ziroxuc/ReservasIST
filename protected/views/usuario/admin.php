<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Administrar',
);
    $this->menu=array(
	array('label'=>'Crear usuario', 'url'=>array('create')));
?>

<h1>Administrar Usuarios <?php
echo CHtml::link(CHtml::encode('Descargar excel'), array('/Usuario/admin','excel'=>'1'),array('class'=>'btn btn-success','style'=>'float:right',));
?> </h1>
   
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rut',
		'nombre',
		'apellido',
		'telefono',
		'email',
		'estado',
                'tipo',
                'rut_padre',
                
		/*
		'fecha_ingreso',
		'fecha_salida',
		'estado',
		'password',
		'tipo',
		'rut_padre',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));
