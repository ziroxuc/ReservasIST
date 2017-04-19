
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
if($tableFco!==null){ 
    
    ?>
  <div class="alert alert-warning">
        <p>A continuación de detallan las solicitudes por jefe de venta.</p>
  </div>         
         
<h3> Total general de solicitudes de Adhesion y adherentes</h3>
<table border="1" class="table table-striped">
    <tr>
         <td bgcolor="#2E64FE"><b>Jefe de venta</b></td>
         <td bgcolor="#2E64FE"><b>Sda en Revision</b></td>
         <td bgcolor="#2E64FE"><b>Sda Completas</b></td>
         <td bgcolor="#2E64FE"><b>Sda Devueltas</b></td>
         <td bgcolor="#2E64FE"><b>Adh en Revision</b></td>
         <td bgcolor="#2E64FE"><b>Adh Completos</b></td>
         <td bgcolor="#2E64FE"><b>Adh Devueltos</b></td>
    </tr>
    <tr>
         <td><b>Francisco Diaz</b></td>
         <td><?php echo $fcoTotalSDAEnRevision?> </td>
         <td><?php echo $fcoTotalSDACompletas?> </td>
         <td><?php echo $fcoTotalSDADevueltas?> </td>
         <td><?php echo $fcoTotalADHRevision?> </td>
         <td><?php echo $fcoTotalADHCompletas?> </td>
         <td><?php echo $fcoTotalADHDevueltas?> </td>
    </tr>
    <tr>
         <td><b>Emmanuel Segura</b></td>
         <td><?php echo $EmTotalSDAEnRevision?> </td>
         <td><?php echo $EmTotalSDACompletas?> </td>
         <td><?php echo $EmTotalSDADevueltas?> </td>
         <td><?php echo $EmTotalADHRevision?> </td>
         <td><?php echo $EmTotalADHCompletas?> </td>
         <td><?php echo $EmTotalADHDevueltas?> </td>
    </tr>
    <tr>
         <td><b>Adolfo Gomez</b></td>
         <td><?php echo $AdTotalSDAEnRevision?></td>
         <td><?php echo $AdTotalSDACompletas?> </td>
         <td><?php echo $AdTotalSDADevueltas?> </td>
         <td><?php echo $AdTotalADHRevision?></td>
         <td><?php echo $AdTotalADHCompletas?> </td>
         <td><?php echo $AdTotalADHDevueltas?> </td>
    </tr>
    <tr>
         <td bgcolor="#F7BE81"><b>Total Gerencia detalle</b></td>
         <td bgcolor="#F7BE81"><?php echo $totalGeneralSDARevision?></td>
         <td bgcolor="#F7BE81"><?php echo $totalGeneralSDACompletas?> </td>
         <td bgcolor="#F7BE81"><?php echo $totalGeneralSDADevueltas?> </td>
         <td bgcolor="#F7BE81"><?php echo $totalGeneralADHRevision?></td>
         <td bgcolor="#F7BE81"><?php echo $totalGeneralADHCompleta?> </td>
         <td bgcolor="#F7BE81"><?php echo $totalGeneralADHDevueltas?> </td>
    </tr>
    <tr>
         <td><b>Total Gerencia Final</b></td>
         <td colspan="3"><?php echo $totalGeneralTodoSDA?></td>
         <td colspan="3"><?php echo $totalGeneralTodoADH?> </td>
    </tr>
</table>    
<br>
<br>

  <div class="alert alert-success">
             <p>A continuación se detallan las solicitudes por supervisor.</p>
               <?php 
        if(isset($month)){
            echo CHtml::link('Descargar datos a Excel',array('ReporteBoss/descargaExcel','op'=>'mes','mesi'=>$month),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary')); 
        }elseif(isset($fech1)&&isset($fech2)){
            echo CHtml::link('Descargar datos a Excel',array('ReporteBoss/descargaExcel','op'=>'rango','fecha1'=>$fech1,'fecha2'=>$fech2),array('style'=>'float:right;margin-top:-27px;','class'=>'btn btn-primary')); 
        }
        ?>
  </div>    

<table border="1" class="table table-striped" id="reporte"> 
   
    <tr>
        <th><b>Nombre Jefe de venta</b></th>
        <th><b>Sda Totales</b></th>
        <th><b>Adh Totales</b></th>
        <th><b>Sda en Revision</b></th>
        <th><b>Adh en Revision</b></th>
        <th><b>Sda Completas</b></th>
        <th><b>Adh Completos</b></th>
        <th><b>Sda Devueltas</b></th>
        <th><b>Adh Devueltos</b></th>
             <th><b>Sda Rechazadas</b></th>
        <th><b>Adh Rechazadas</b></th>
             <th><b>Sda Renuncia</b></th>
        <th><b>Adh Renuncia</b></th>
        <th><b>Detalle</b></th>
    </tr>
   
    <tr>  
        <td>Francisco Diaz</td> 
        <td><?php  echo $fcoTotalEmpresas ?></td>
        <td><?php  echo $fcoTotalTrabajadores ?></td>
        <td><?php  echo $fcoEnRevisionSDA ?></td>
        <td><?php  echo $fcoEnRevisionADH ?></td>
        <td><?php  echo $fcoCompletasSDA ?></td>
        <td><?php  echo $fcoCompletasADH ?></td>
        <td><?php  echo $fcoDevueltasSDA ?></td>
        <td><?php  echo $fcoDevueltasADH ?></td>
        
        <td><?php  echo $fcoRechazadaSDA ?></td>
        <td><?php  echo $fcoRechazadaADH ?></td>
        <td><?php  echo $fcoRenunciaSDA ?></td>
        <td><?php  echo $fcoRenunciaADH ?></td>
        <td></td>

    </tr>

    <tr>
         <td colspan="14"><b>Detalle por supervisores</b></td>
    </tr>
    
     <?php foreach($tableFco as $data1){ ?>
    <tr>
        <?php echo $data1; ?>
    </tr>
    <?php } ?>
     <tr>
         <td><b>Porcentaje de aceptación</b></td>
         <td colspan="13" style="text-align: right">  <?php echo  $porcenAceptacionFco; ?>% </td>
     </tr>
</table>
<br>
<table border="1" class="table table-striped">
    <tr>
      <td><b>Nombre Jefe de venta</b></td>
        <td><b>Sda Totales</b></td>
        <td><b>Adh Totales</b></td>
        <td><b>Sda en Revision</b></td>
        <td><b>Adh en Revision</b></td>
        <td><b>Sda Completas</b></td>
        <td><b>Adh Completos</b></td>
        <td><b>Sda Devueltas</b></td>
        <td><b>Adh Devueltos</b></td>
        <th><b>Sda Rechazadas</b></th>
        <th><b>Adh Rechazadas</b></th>
             <th><b>Sda Renuncia</b></th>
        <th><b>Adh Renuncia</b></th>
        <th><b>Detalle</b></th>
    </tr>
    <tr>  
        <td>Emmanuel Segura</td> 
       <td><?php  echo $EmTotalEmpresas ?></td>
        <td><?php  echo $EmTotalTrabajadores ?></td>
        <td><?php  echo $EmEnRevisionSDA ?></td>
        <td><?php  echo $EmEnRevisionADH ?></td>
        <td><?php  echo $EmCompletasSDA ?></td>
        <td><?php  echo $EmCompletasADH ?></td>
        <td><?php  echo $EmDevueltasSDA ?></td>
        <td><?php  echo $EmDevueltasADH ?></td>
        <td><?php  echo $EmRechazadaSDA ?></td>
        <td><?php  echo $EmRechazadaADH ?></td>
        <td><?php  echo $EmRenunciaSDA ?></td>
        <td><?php  echo $EmRenunciaADH ?></td>
        <td></td>
    </tr> 


     <tr>
         <td colspan="14"><b>Detalle por supervisores</b></td>
    </tr>
     <?php foreach($tableEmm as $data2){ ?>
    <tr>
        <?php echo $data2; ?>
    </tr>    
    <?php } ?>
       <tr>
         <td><b>Porcentaje de aceptacion</b></td>
         <td colspan="13" style="text-align: right"><?php echo $porcenAceptacionEm; ?>% </td>
     </tr>  
   
</table>
<br>
<table border="1"  class="table table-striped">
    <tr>
      <td><b>Nombre Jefe de venta</b></td>
        <td><b>Sda Totales</b></td>
        <td><b>Adh Totales</b></td>
        <td><b>Sda en Revision</b></td>
        <td><b>Adh en Revision</b></td>
        <td><b>Sda Completas</b></td>
        <td><b>Adh Completos</b></td>
        <td><b>Sda Devueltas</b></td>
        <td><b>Adh Devueltos</b></td>
    <th><b>Sda Rechazadas</b></th>
        <th><b>Adh Rechazadas</b></th>
             <th><b>Sda Renuncia</b></th>
        <th><b>Adh Renuncia</b></th>
        <th><b>Detalle</b></th>
    </tr> 
    <tr>  
        <td>Adolfo Gomez</td> 
        <td><?php  echo $AdTotalEmpresas ?></td>
        <td><?php  echo $AdTotalTrabajadores ?></td>
        <td><?php  echo $AdIngresadas ?></td>
        <td><?php  echo $AdIngresadasADH ?></td>
        <td><?php  echo $AdCompletas ?></td>
        <td><?php  echo $AdCompletasADH ?></td>
        <td><?php  echo $AdIncompletas ?></td>
        <td><?php  echo $AdIncompletasADH ?></td>
        
        <td><?php  echo $AdRechazada ?></td>
        <td><?php  echo $AdRechazadaADH ?></td>
        <td><?php  echo $AdRenuncia ?></td>
        <td><?php  echo $AdRenunciaADH ?></td>
        <td></td>
    </tr> 


    <tr>
         <td colspan="14"><b>Detalle por supervisores</b></td>
    </tr>
    <?php foreach($tableAdolfo as $data3){ ?>
    <tr>
        <?php echo $data3; ?>
    </tr>    
    <?php } ?>
     <tr>
         <td><b>Porcentaje de aceptación</b></td>
         <td colspan="13" style="text-align: right"><?php echo $porcenAceptacionAd; ?>% </td>
     </tr> 
    
</table>
<br>
<?php } ?>

      <?php
      echo CHtml::link(CHtml::encode('Salir y cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-danger','style'=>'float:right',));
      echo CHtml::link(CHtml::encode('Visualizar otro mes'), array('/reporteBoss/index'),array('class'=>'btn btn-primary'));
           
      ?>
      


               
    

    



