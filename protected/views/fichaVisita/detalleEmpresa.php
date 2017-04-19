
<h3>Detalle de Empresas</h3>
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
<table border="0" style="border-spacing: 8px; border-collapse: separate;"> 
 
   <tbody> 
     <?php foreach($detalleEmpresa as $data){ ?>
    <tr>
        <td><b>Nombre ejecutivo</b></td>
        <td><?php echo $data['nombre_eje']; ?></td>
    </tr>
    <tr>
        <td><b>Rut ejecutivo</b></td>
        <td><?php echo $data['rut_eje']; ?></td>
    </tr>
    <tr>
        <td><b>Nombre empresa</b></td>
         <td><?php echo CHtml::link($data['nombre_empresa'], array('fichaVisita/detalleEmpresa', 'id'=>$data['id']),array('style'=>'color:blue;')); ?></td>
    </tr>
    <tr>
        <td><b>Rut Empresa</b></td>
        <td><?php echo $data['rut_empresa']; ?></td>
    </tr>
    <tr>
        <td><b>Dirección Empresa</b></td>
        <td><?php echo $data['direccion_empresa']; ?></td>
    </tr>
    <tr>
        <td><b>Comuna empresa</b></td>
        <td><?php echo $data['comuna_empresa']; ?></td>
    </tr>
    <tr>
        <td><b>Fono empresa</b></td>
        <td><?php echo $data['fono_empresa']; ?></td>
    </tr>
    <tr>
        <td><b>Nombre de contacto</b></td>
        <td><?php echo $data['nombre_contacto']; ?></td>
    </tr>
     <tr>
        <td><b>Fecha de la visita</b></td>
        <td><?php echo $data['fecha_visita']; ?></td>
    </tr>
     <tr>
        <td><b>Fecha de ingreso</b></td>
        <td><?php echo $data['fecha_ingreso']; ?></td>
    </tr>

     <tr>
        <td><b>Fecha posible cierre</b></td>
        <td><?php echo $data['fech_pos_cierre']; ?></td>
    </tr>
     <tr>
        <td><b>Comentario posible cierre</b></td>
        <td><?php echo $data['fech_pos_cierre_com']; ?></td>
    </tr>
    
    <tr>
        <td><b>Visitada</b></td>
        <td><?php echo $data['visita']; ?></td>
    </tr>
     <tr>
        <td><b>Comentario visita</b></td>
        <td><?php echo $data['visita_com']; ?></td>
    </tr>
       <?php if(Yii::app()->user->getState('tipo')!="supervisor"){?>
    <tr>
        <td><b>Comentario auditoria</b></td>
        <td><?php echo $data['com_auditoria']; ?></td>
    </tr> 
     <?php } ?>
       
    </tr>
    <?php } ?>
    </tbody> 
</table>