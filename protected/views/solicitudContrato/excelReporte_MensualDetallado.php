<?php

if($tableFco!==null){ 
    
    ?>

<h2> Reporte gerencia de adherentes mes de <?php echo $month?> del <?php 

//date_default_timezone_set("America/Santiago");
date_default_timezone_set('UTC');
//$hora = time();
echo date('Y');
echo "<br>";
echo "Fecha de emision:";
echo " ";
echo date('d/m/Y');
echo " a las ";
echo date('H:i');
echo " hrs.";
?>
</h2>
<br>
<h3> Total general de solicitudes de Adhesion y adherentes</h3>
<table border="1" bgcolor="#CEE3F6" >
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
         <td bgcolor="#FE2E2E"><b>Total Gerencia Final</b></td>
         <td bgcolor="#FE2E2E" colspan="3"><?php echo $totalGeneralTodoSDA?></td>
         <td bgcolor="#FE2E2E" colspan="3"><?php echo $totalGeneralTodoADH?> </td>
    </tr>
</table>    
<br>
<br>
<h3> Porcentaje de cumplimiento (sda completas vs meta)</h3>
<table border="1" bgcolor="#CEE3F6" >
    <tr>
         <td bgcolor="#2E64FE"><b>Jefe de venta</b></td>
         <td bgcolor="#2E64FE"><b>Sda completas</b></td>
         <td bgcolor="#2E64FE"><b>Meta de Sda</b></td>
         <td bgcolor="#2E64FE"><b>Adh Completos</b></td>
         <td bgcolor="#2E64FE"><b>Meta de Adh</b></td>
    </tr>
    <tr>
         <td><b>Francisco Diaz</b></td>
         <td> <?php echo $PorcentajeCumpliSDAfco?> %</td>
         <td><?php  echo  $metaSDA?> </td>
         <td><?php  echo  $PorcentajeCumpliADHfco?> %</td>
         <td><?php echo $metaADH?> </td>
       
    </tr>
    <tr>
         <td><b>Emmanuel Segura</b></td>
         <td><?php echo $PorcentajeCumpliSDAEm?> %</td>
         <td><?php echo $metaSDA?> </td>
         <td><?php echo $PorcentajeCumpliADHEm?> %</td>
         <td><?php echo $metaADH?> </td>
      
    </tr>
    <tr>
         <td><b>Adolfo Gomez</b></td>
         <td><?php echo $PorcentajeCumpliSDAAd?> %</td>
         <td><?php echo $metaSDA?> </td>
         <td><?php echo $PorcentajeCumpliADHAd?> %</td>
         <td><?php echo $metaADH?> </td>
        
    </tr>
</table>    
<br>
<br>
<h3> Porcentaje de aporte a la gerencia (Sda completas individuales vs Sda completas totales)</h3>
<table border="1" bgcolor="#CEE3F6" >
    <tr>
         <td bgcolor="#2E64FE"><b>Jefe de venta</b></td>
         <td bgcolor="#2E64FE"><b>Sda completas</b></td>
         <td bgcolor="#2E64FE"><b>Sda completas totales</b></td>
         <td bgcolor="#2E64FE"><b>Adh completos</b></td>
         <td bgcolor="#2E64FE"><b>Adh completos totales</b></td>
    </tr>
    <tr>
         <td><b>Francisco Diaz</b></td>
         <td> <?php echo $PorcentajeAporteSDAfco?> %</td>
         <td> <?php echo $factorTotalSDA?> </td>
         <td><?php echo $PorcentajeAporteADHfco?> %</td>
         <td> <?php echo $factorTotalADH?> </td>
    </tr>
    <tr>
         <td><b>Emmanuel Segura</b></td>
         <td><?php echo $PorcentajeAporteSDAEm?> %</td>
         <td> <?php echo $factorTotalSDA?> </td>
         <td><?php echo $PorcentajeAporteADHEm?> %</td>
         <td> <?php echo $factorTotalADH?> </td>
    </tr>
    <tr>
         <td><b>Adolfo Gomez</b></td>
         <td><?php echo $PorcentajeAporteSDAAd?>% </td>
         <td> <?php echo $factorTotalSDA?> </td>
         <td><?php echo $PorcentajeAporteADHAd?>% </td>
         <td> <?php echo $factorTotalADH?> </td>
    </tr>
</table>    
<br>
<br>

   
<h3>Reporte detallado de solicitudes mes de <?php echo $month?> del <?php echo date("Y"); ?></h3>
<table border="1" bgcolor="#F8ECE0" > 
    <tr>
        <td bgcolor="#F5D0A9"><b>Nombre supervisor</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Totales</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Totales</b></td>
        <td bgcolor="#F5D0A9"><b>Sda en Revision</b></td>
        <td bgcolor="#F5D0A9"><b>Adh en Revision</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Completas</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Completos</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Devueltas</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Devueltos</b></td>
        <td bgcolor="#F5D0A9"><b>Meta Sda</b></td>
        <td bgcolor="#F5D0A9"><b>Meta Adh</b></td>
        <td bgcolor="#F5D0A9"><b>Sda faltantes</b></td>
        <td bgcolor="#F5D0A9"><b>Adh faltantes</b></td>
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
        <td><?php  echo $metaSDA ?></td>
        <td><?php  echo $metaADH ?></td>
        <td><?php  echo $faltantesFcoSDA ?></td>
        <td><?php  echo $faltantesFcoADH ?></td>

    </tr>
</table>
<table border="1">
    <tr>
        <td colspan="9" bgcolor="#F5D0A9"><b>Detalle por supervisores</b></td>
    </tr>
    
     <?php foreach($tableFco as $data1){ ?>
    <tr>
        <?php echo $data1; ?>
    </tr>    
    <?php } ?>
     <tr>
         <td bgcolor="#FE642E"><b>Porcentaje de aceptacion</b></td>
         <td colspan="8" style="text-align: right" bgcolor="#FE642E">  <?php echo  $porcenAceptacionFco; ?>% </td>
     </tr>
</table>
<br>
<table border="1" bgcolor="#F8ECE0" >
    <tr>
        <td bgcolor="#F5D0A9"><b>Nombre supervisor</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Totales</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Totales</b></td>
        <td bgcolor="#F5D0A9"><b>Sda en Revision</b></td>
        <td bgcolor="#F5D0A9"><b>Adh en Revision</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Completas</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Completos</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Devueltas</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Devueltos</b></td>
        <td bgcolor="#F5D0A9"><b>Meta Sda</b></td>
        <td bgcolor="#F5D0A9"><b>Meta Adh</b></td>
        <td bgcolor="#F5D0A9"><b>Sda faltantes</b></td>
        <td bgcolor="#F5D0A9"><b>Adh faltantes</b></td>
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
        <td><?php  echo $metaSDA ?></td>
        <td><?php  echo $metaADH ?></td>
        <td><?php  echo $faltantesEmSDA ?></td>
        <td><?php  echo $faltantesEmADH ?></td>
    </tr> 
</table>
<table border="1">
     <tr>
         <td colspan="9" bgcolor="#F5D0A9"><b>Detalle por supervisores</b></td>
    </tr>
     <?php foreach($tableEmm as $data2){ ?>
    <tr>
        <?php echo $data2; ?>
    </tr>    
    <?php } ?>
       <tr>
 
         <td bgcolor="#FE642E"><b>Porcentaje de aceptacion</b></td>
         <td colspan="8" style="text-align: right" bgcolor="#FE642E"><?php echo $porcenAceptacionEm; ?>% </td>
     </tr>  
   
</table>
<br>
<table border="1" bgcolor="#F8ECE0" >
    <tr>
        <td bgcolor="#F5D0A9"><b>Nombre supervisor</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Totales</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Totales</b></td>
        <td bgcolor="#F5D0A9"><b>Sda en Revision</b></td>
        <td bgcolor="#F5D0A9"><b>Adh en Revision</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Completas</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Completos</b></td>
        <td bgcolor="#F5D0A9"><b>Sda Devueltas</b></td>
        <td bgcolor="#F5D0A9"><b>Adh Devueltos</b></td>
        <td bgcolor="#F5D0A9"><b>Meta Sda</b></td>
        <td bgcolor="#F5D0A9"><b>Meta Adh</b></td>
        <td bgcolor="#F5D0A9"><b>Sda faltantes</b></td>
        <td bgcolor="#F5D0A9"><b>Adh faltantes</b></td>
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
        <td><?php  echo $metaSDA ?></td>
        <td><?php  echo $metaADH ?></td>
        <td><?php  echo $faltantesAdSDA ?></td>
        <td><?php  echo $faltantesAdADH ?></td>
    </tr> 
</table>
<table border="1">
    <tr>
         <td colspan="9" bgcolor="#F5D0A9"><b>Detalle por supervisores</b></td>
    </tr>
    <?php foreach($tableAdolfo as $data3){ ?>
    <tr>
        <?php echo $data3; ?>
    </tr>    
    <?php } ?>
     <tr>
         <td bgcolor="#FE642E"><b>Porcentaje de aceptacion</b></td>
         <td colspan="8" style="text-align: right" bgcolor="#FE642E"><?php echo $porcenAceptacionAd; ?>% </td>
     </tr> 
    
</table>
<br>
<?php } ?>


