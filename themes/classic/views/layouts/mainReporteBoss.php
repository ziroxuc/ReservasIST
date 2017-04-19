<?php
$user = Yii::app()->user;
if (!$user->getIsGuest()) {
    $time = ($user->getState(CWebUser::AUTH_TIMEOUT_VAR) - time() + 2) * 1000; //converting to millisecs
    Yii::app()->clientScript->registerSCript('timeout', '
     setTimeout(function(){
                  window.location="' . Yii::app()->createUrl("site/login", array('id' => 'expire')) . '"  ;
                },' . $time . ')', CClientScript::POS_END);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="language" content="en" />
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Le styles -->
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/datatables.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END );?>
        
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/jquery.rut.js', CClientScript::POS_END );?>
          
       <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
       <?php Yii::app()->clientscript->registerCssFile( Yii::app()->theme->baseUrl . '/css/dataTableCss.css' ); ?>
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->request->baseUrl . '/cssB/bootstrapBoss.min.css' ); ?>
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->request->baseUrl . '/cssB/bootstrap-responsive.min.css' ); ?>
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->request->baseUrl . '/cssB/grid.css' ); ?>	
        
    </head>
    <body>
         <nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Sistema de Reservas</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
        
      <?php if(Yii::app()->user->getState("tipo")==="administrador"){ ?>
       <li class="active"><?php echo CHtml::link(CHtml::encode('Inicio'), array('/solicitudContrato/admin'),array('class'=>'')); ?></li>
      <?php }else{ ?>
          <li class="active"><?php echo CHtml::link(CHtml::encode('Inicio'), array('/reporteBoss/index'),array('class'=>'')); ?></li>        
       <?php
      }
      ?> 
      
      <?php if(Yii::app()->user->getState("tipo")==="jefe de venta"||Yii::app()->user->getState("tipo")==="gerente"){ ?>
      
      <li><?php echo CHtml::link(CHtml::encode('Registro conexiones'), array('/reporteBoss/verAccesos','tipo'=>Yii::app()->user->getState("tipo")),array('class'=>''));?></li>
                
      <li><?php echo CHtml::link(CHtml::encode('Dotación'), array('/reporteBoss/verDotacion','tipo'=>Yii::app()->user->getState("tipo")),array('class'=>''));?></li>
               
      <?php } ?>
      
     
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Autoevaluaciones <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
           
           <li><?php echo CHtml::link(CHtml::encode('Ver Autoevaluaciones'), array('/fichaVisita/admin'),array('class'=>''));?></li>
          
         <?php if(Yii::app()->user->getState("tipo")==="supervisor"){?>
      
        <li><?php echo CHtml::link(CHtml::encode('Agregar Autoevaluación'), array('/fichaVisita/create'),array('class'=>''));?></li>
        <li><?php echo CHtml::link(CHtml::encode('Autoevaluaciones por ejecutivo'), array('/fichaVisita/contarVisitasSup'),array('class'=>''));?></li>
                            
      <?php }?>
        
         <?php if(Yii::app()->user->getState("tipo")==="jefe de venta"||Yii::app()->user->getState("tipo")==="gerente"){?>
         <li><?php echo CHtml::link(CHtml::encode('Autoevaluaciones por ejecutivo'), array('/fichaVisita/contarVisitas'),array('class'=>''));?></li>
         <li><?php echo CHtml::link(CHtml::encode('Resumen de Autoevaluaciones'), array('/fichaVisita/reporteVisitas'),array('class'=>''));?></li>
        <?php }?>
        </ul>
      </li>
      <?php if(Yii::app()->user->getState("tipo")==="jefe de venta"||Yii::app()->user->getState("tipo")==="gerente"){?>
       
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Reportes especiales <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><?php echo CHtml::link(CHtml::encode('Empresas Mayores'), array('/reporteBoss/reporteEspecial'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Ranking Ejecutivos'), array('/reporteBoss/ranking'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Ranking Mensual Ejecutivos'), array('/reporteBoss/rankingMensual'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Ranking Mensual Empresas'), array('/reporteBoss/rankingEmpresas'),array('class'=>''));?></li>
       
        </ul>
      </li>
       
     <?php }?>
       
    </ul>
            <p class="navbar-text pull-right">
                <?php echo "Usuario: ".Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido")." ".
               CHtml::link(CHtml::encode('Cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-danger btn-xs'));
                
                ?>
            </p>

  </div>
</nav>
        
<!--       <script>
           $(document).ready(function(){
                    colors = ['#FF0000', '#F7FE2E'];
                    var i = 0;
                    animate_loop = function() {      
                    $('#alerta').animate({backgroundColor:colors[(i++)%colors.length]
                            }, 50, function(){
                                    animate_loop();
                            });
                    }
                    animate_loop();
            }); 
            
        </script>    -->
        
        <?php if(Yii::app()->user->getState("tipo")!=="administrador"){ ?>
            <?php $x= new SolicitudContrato();
            $rut=  Yii::app()->user->getState("rut");
            $alertas=$x->Alertas();
            if($alertas>0){
             ?>
            <div class="alert alert-danger"id="alerta">
               <h4 style="text-align: center;"> <?php echo CHtml::link('Existen '.$alertas.' solicitudes de contrato vencidas.', array('reporteBoss/verAlertas','rut'=>$rut)); ?></h4>

            </div> 
            <?php } ?>
        <?php } ?>
       
        <div class="container" style="background-color: white;">             
             
                <?php echo $content ?> 

       </div><!--/.fluid-container-->
        
      <div class="footer">
            <div class="container">
                <div class="row">
                    <br>
                    <br>
                </div> <!-- /row -->
            </div> <!-- /container -->
      </div>
      
      
    </body>
    
</html>
