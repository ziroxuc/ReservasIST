      <div class="page-header">
      
        <p class="lead">
            Reporte mes de <?php echo $month?> del <?php 

            //date_default_timezone_set("America/Santiago");
            date_default_timezone_set('UTC');
            //$hora = time();
            echo date('Y');
            echo " Fecha de emision:";
            echo " ";
            echo date('d/m/Y');
            echo " a las ";
            echo date('H:i');
            echo " hrs.";
            ?>  
        </p>
      </div>

      <h3>Tabla de reporte</h3>
       <div class="alert alert-warning">
        <p>A continuación se muestra el total de empresas y el total de adherentes para el mes seleccionado.</p>
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
      echo CHtml::link(CHtml::encode('Salir y cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-primary','style'=>'float:right',));
      echo CHtml::button('Visualizar otro mes', array(
            'name' => 'btnBack',
            'class' => 'btn btn-primary',
            'onclick' => "history.go(-1)",
                )
        ); 
      ?>


               
    

    



