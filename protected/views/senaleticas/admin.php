<h3>Señaleticas solicitadas</h3>
<div style="height: 10px;"> </div>
<?php
$x = new Senaleticas();
$x->verificaVencidas();
$this->menu=array(
	
	//array('label'=>'Crear nueva Autoevaluación', 'url'=>array('create')),
        //array('label'=>'Ver registro de Autoevaluaciones', 'url'=>array('admin')),
        array('label'=>'Volver', 'url'=>array('reporteBoss/index')),
);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'senaleticas-grid',
	'dataProvider'=>$model->search(),
       'rowCssClassExpression'=>'($data->estado=="Devuelta")?"rechazada":(($data->estado=="Pendiente")?"ingresada":"aprobada")',

	'filter'=>$model,
	'columns'=>array(
                'nombre_jv',
                'nombre_sup',
                'nombre_eje',
                'rut_empresa',
                'fecha_entrega',
                'usuario_web',
                'estado',
		array
(
                'class'=>'CButtonColumn',
                'template'=>'{view}{terminar}{delete}',
                'buttons'=>array
                (
                    'terminar' => array
                    (
                        'label'=>'Terminar proceso',
                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/visto.jpg',
                        'url'=>'Yii::app()->createUrl("senaleticas/viewAgregarDatos", array("id"=>$data->id))',
                    ),
                    
                ),
            ),
	),
));