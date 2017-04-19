<?php
//excel de Seguros
if($model!==null){ ?>
<table border="1" >
    <tr>
        <td><b>Numero certificado</b></td>
        <td><b>Fecha Vigencia</b></td>
        <td><b>Fecha Ingreso</b></td>
        <td><b>Nombre</b></td>
        <td><b>Rut</b></td>
        <td><b>Digito</b></td>
        <td><b>Fecha Nacimiento</b></td>
        <td><b>Sexo</b></td>
        <td><b>Direccion</b></td>
        <td><b>Comuna</b></td>
        <td><b>Region</b></td>
        <td><b>Fono Particular</b></td>
        <td><b>Celular</b></td>
        <td><b>email</b></td>
        <td><b>Producto</b></td>
        <td><b>plan</b></td>
        <td><b>odonto Individual</b></td>
        <td><b>Odonto Familiar</b></td>
        <td><b>Renta Mensual</b></td>
        <td><b>Interveniones Quirurgicas</b></td>
        <td><b>Prima Mensual UF</b></td>
        <td><b>Inicio Cobranza</b></td>
        <td><b>Via de Pago</b></td>
        <td><b>Banco</b></td>
        <td><b>Nombre Banco</b></td>
        <td><b>Numero Cta.Cte</b></td>
        <td><b>Numero tarjeta</b></td>
        <td><b>Codigo Sucursal</b></td>
        <td><b>Nombre Empresa</b></td>
        <td><b>Rut Empresa</b></td>
        <td><b>Digito Empresa</b></td>
        <td><b>Nombre ejecutivo</b></td>
        <td><b>Rut ejecutivo</b></td>
    </tr>    
   <?php
   foreach ($model as $datos){?> 
     <tr>
        <td><?php  echo $datos->numero_certificado   ?></td>
        <td><?php  echo $datos->fecha_vigencia  ?></td>
        <td><?php  echo $datos->fecha_ingreso  ?></td>   
        <td><?php  echo $datos->rut_ejecutivo  ?></td>
        <td><?php  echo $datos->nombre_ejecutivo  ?></td>
        <td><?php  echo $datos->nombre  ?></td>
        <td><?php  echo $datos->rut  ?></td>
        <td><?php  echo $datos->digito  ?></td>           
        <td><?php  echo $datos->fecha_nacimiento ?></td> 
        <td><?php  echo $datos->sexo  ?></td>
        <td><?php  echo $datos->direccion  ?></td>
        <td><?php  echo $datos->comuna  ?></td>
        <td><?php  echo $datos->region  ?></td>
        <td><?php  echo $datos->fono_particular?></td>  
        <td><?php  echo $datos->celular  ?></td>
        <td><?php  echo $datos->email  ?></td>
        <td><?php  echo $datos->producto ?></td>
        <td><?php  echo $datos->plan  ?></td>
        <td><?php  echo $datos->odonto_individual?></td>  
        <td><?php  echo $datos->odonto_familiar  ?></td>
        <td><?php  echo $datos->renta_mensual  ?></td>
        <td><?php  echo $datos->interven_quirurgicas  ?></td>
        <td><?php  echo $datos->prima_mensual_uf  ?></td>
        <td><?php  echo $datos->inicio_cobranza  ?></td>
        <td><?php  echo $datos->via_pago  ?></td>
        <td><?php  echo $datos->banco  ?></td>
        <td><?php  echo $datos->nombre_banco  ?></td>
        <td><?php  echo $datos->num_cta_corriente  ?></td>
        <td><?php  echo $datos->num_tarjeta  ?></td>
        <td><?php  echo $datos->codigo_sucursal  ?></td>
        <td><?php  echo $datos->nombre_empresa  ?></td>
        <td><?php  echo $datos->rut_empresa  ?></td>
        <td><?php  echo $datos->digito_empresa  ?></td>
        <td><?php  echo $datos->rut_ejecutivo  ?></td>
        <td><?php  echo $datos->nombre_ejecutivo  ?></td>       
    </tr> 
   <?php } ?>
</table>
<?php } ?>


