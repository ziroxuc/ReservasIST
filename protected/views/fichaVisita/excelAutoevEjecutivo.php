<?php if($tabla!==null){ ?>
<table class="display" id="tablaConteo" border="1"> 
    <thead>
    <tr>
        <td></td>
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
<?php } ?>
