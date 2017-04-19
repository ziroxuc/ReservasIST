
      <div class="page-header">
     
        <p class="lead">
            <?php if(isset($month)){ ?> 
            Reporte mes de <?php echo $month?> del <?php 
            }else{
             ?>   
             Reporte para el rango de fechas entre <?php echo $fech1?> y <?php echo $fech2?> del <?php    
            }
            //date_default_timezone_set("America/Santiago");
            date_default_timezone_set('UTC');
            //$hora = time();
            echo date('Y');
            echo " Fecha de emision:";
            echo " ";
            echo date('d/m/Y');
            
            ?>  
        </p>
      </div>

      <h3>Tabla de reporte</h3>
       <div class="alert alert-warning">
        <p>A continuación se muestra el total de empresas y el total de adherentes Completos.</p>
      </div>
      <div class="row">
        <div class="col-xs-4 col-sm-4"><strong>Gerencia</strong></div>
        <div class="col-xs-4 col-sm-4"><strong>Empresas</strong></div>
        <div class="col-xs-4 col-sm-4"><strong>Adherentes</strong></div>
        <div class="col-xs-4 col-sm-4"><strong>Total</strong></div>
        <div class="col-xs-4 col-sm-4"><?php echo $totalGeneralTodoSDACom?></div>
        <div class="col-xs-4 col-sm-4"><?php echo $totalGeneralTodoADHCom?></div>
      </div>
     
         <h3>Tabla de reporte Acumulado</h3>
         <div class="alert alert-success">
             <p>A continuación se muestra el total de empresas y el total de adherentes acumulado hasta la fecha actual.</p>
         </div>
         
       <div class="row">
        <div class="col-xs-4 col-sm-4"><strong>Gerencia</strong></div>
        <div class="col-xs-4 col-sm-4"><strong>Empresas</strong></div>
        <div class="col-xs-4 col-sm-4"><strong>Adherentes</strong></div>
        <div class="col-xs-4 col-sm-4"><strong>Total</strong></div>
        <div class="col-xs-4 col-sm-4"><?php echo $EmpAcumulado?></div>
        <div class="col-xs-4 col-sm-4"><?php echo $AdhAcumulado?></div>
      </div>
         
         <?php

         
         if($tabla!==null){ 
    
    ?>
         
  <div class="alert alert-warning">
        <p>A continuación se detallan las solicitudes de los ejecutivos. </p>
        <?php 
        if(isset($month)){
            echo CHtml::link('Descargar datos a Excel',array('ReporteBoss/descargaExcel','op'=>'mes','mesi'=>$month),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary')); 
        }elseif(isset($fech1)&&isset($fech2)){
            echo CHtml::link('Descargar datos a Excel',array('ReporteBoss/descargaExcel','op'=>'rango','fecha1'=>$fech1,'fecha2'=>$fech2),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary')); 
        }
        ?>
  </div>
         
<table border="1" class="table table-striped"> 
    <tr>
        <td><b>Nombre Ejecutivo</b></td>
        <td><b>Sda Totales</b></td>
        <td><b>Adh Totales</b></td>
        <td><b>Sda en Revision</b></td>
        <td><b>Adh en Revision</b></td>
        <td><b>Sda Completas</b></td>
        <td><b>Adh Completos</b></td>
        <td><b>Sda Devueltas</b></td>
        <td><b>Adh Devueltos</b></td>
          <td><b>Sda Rechazadas</b></td>
        <td><b>Adh Rechazadas</b></td>
        <td><b>Sda Renuncia</b></td>
        <td><b>Adh Renuncia</b></td>
        <td><b>Detalle</b></td>
    </tr> 
    <?php
 
    ?>
   
     <?php foreach($tabla as $data1){ ?>
    
        <?php echo $data1; ?>
 
    <?php } ?>

    
</table>

<?php } ?>

      <?php
      echo CHtml::link(CHtml::encode('Salir y cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-danger','style'=>'float:right',));
      
      if(Yii::app()->user->getState("tipo")==="jefe de venta" || Yii::app()->user->getState("tipo")==="gerente"){
         if(isset($fech1)){
            echo CHtml::link('Volver',Yii::app()->request->urlReferrer, array('class'=>'btn btn-primary'));
            
         }else{
            echo CHtml::button('Volver', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        );
         }
     }else{
       echo CHtml::button('Volver', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        );
     }
      
      
      ?>
               


               
    

    



