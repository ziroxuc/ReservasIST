<?php
/* @var $this FichaVisitaController */
/* @var $model FichaVisita */

$this->breadcrumbs=array(
	'Autoevaluaciones'=>array('admin'),
	//$model->id,
);

$this->menu=array(
        array('label'=>'Crear nueva Autoevaluación', 'url'=>array('create')),
	array('label'=>'Editar Autoevaluación', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ficha de visita', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Autoevaluaciones', 'url'=>array('admin')),
);
?>

<h1>Ver Autoevaluación #<?php echo $model->id; echo CHtml::link('<< Volver',Yii::app()->request->urlReferrer, array('class'=>'btn btn-success','style'=>'float:right;')); ?></h1>
 
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rut_jv',
		'nombre_jv',
		'rut_sup',
		'nombre_sup',
		'rut_eje',
		'nombre_eje',
		'rut_empresa',
		'nombre_empresa',
                'cantidad_trab',
		'direccion_empresa',
		'comuna_empresa',
		'fono_empresa',
		'nombre_contacto',
		'fecha_visita',
                'fecha_ingreso',
                'fech_pos_cierre',
                'cantidad_trab',
                'fech_vencimiento',
                'estado',
                'comentario',
                'total_cumple',
                'total_nocumple',
                'total_noaplica',
                'GTL1',
                'GTL2',
                'GTL3',
                'GTL4',
                'GTL5',
                'GTL6',
                'GTL7',
                'GTL8',
                'GTL9',
	),
)); ?>
