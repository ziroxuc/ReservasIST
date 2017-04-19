
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
<?php
Yii::app()->clientscript
// use it when you need it!
/*
  ->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
  ->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
  ->registerCoreScript( 'jquery' )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
 */
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
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/datatables.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/jquery.Rut.min.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END );?>
        
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' ); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END );?>
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->theme->baseUrl . '/css/dataTableCss.css' ); ?>
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' ); ?>
        <?php Yii::app()->clientscript->registerCssFile( Yii::app()->theme->baseUrl . '/css/style.css' ); ?>
     
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">

                    <a class="brand" href="#"><?php echo Yii::app()->name ?></a>
                    <div class="nav-collapse">

                    <?php if (Yii::app()->user->getState("tipo") === "administrador") { ?>
                            
                        <ul class="nav navbar-nav">
                           
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Autoevaluaciones <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo CHtml::link(CHtml::encode('Ver Autoevaluaciones'), array('/fichaVisita/admin'),array('class'=>''));?></li>
                                    <li><?php echo CHtml::link(CHtml::encode('Autoevaluaciones por ejecutivo'), array('/fichaVisita/contarVisitas'),array('class'=>''));?></li>
                                    <li><?php echo CHtml::link(CHtml::encode('Resumen de Autoevaluaciones'), array('/fichaVisita/reporteVisitas'),array('class'=>''));?></li>
                                </ul>
                          </li>
                          
                          
                          
                          
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                     <li><?php echo CHtml::link(CHtml::encode('Dotación'), array('/Usuario/admin'),array('class'=>''));?></li>
                                     <li><?php echo CHtml::link(CHtml::encode('Dependencias'), array('/Usuario/dependencias'),array('class'=>''));?></li>
                                </ul>
                          </li>
                          <li><?php echo CHtml::link(CHtml::encode('Solicitud de Adhesión'), array('/solicitudContrato/admin'),array('class'=>''));?></li>
                          <li><?php echo CHtml::link(CHtml::encode('Auditoria'), array('/registroContratos/admin'),array('class'=>''));?></li>
                          <li><?php echo CHtml::link(CHtml::encode('Bonos'), array('/bonos/index'),array('class'=>''));?></li>
                          
                          <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Reportes especiales <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><?php echo CHtml::link(CHtml::encode('Empresas Mayores'), array('/reporteBoss/reporteEspecial'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Ranking Ejecutivos'), array('/reporteBoss/ranking'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Ranking Mensual Ejecutivos'), array('/reporteBoss/rankingMensual'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Ranking Mensual Empresas'), array('/reporteBoss/rankingEmpresas'),array('class'=>''));?></li>
          <li><?php echo CHtml::link(CHtml::encode('Entrega de señaleticas'), array('/senaleticas/admin'),array('class'=>''));?></li>
      
        </ul>
      </li>
                             <?php
                        } elseif (Yii::app()->user->getState("tipo") === "supervisor") {
                            $this->widget('zii.widgets.CMenu', array(
                                'htmlOptions' => array('class' => 'nav'),
                                'activeCssClass' => 'active',
                                'items' => array(
                                    array('label' => 'Inicio', 'url' => array('/reporteBoss/index')),
                                    array('label' => 'Autoevaluaciones', 'url' => array('/fichaVisita/create')),
                                ),
                            ));
                        } 
                        ?>
                       </ul>
                    </div><!--/.nav-collapse -->
                    <div class="usuario"> <?php
                        if (isset(Yii::app()->user->isGuest)) {
                            echo "<b>" . Yii::app()->user->getState("nombre") . " " . Yii::app()->user->getState("apellido") . "</b>" . " " . CHtml::link(CHtml::encode('Cerrar sesión'), array('/site/logout'));
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="cont">
            <div class="container-fluid">


<?php if (isset($this->breadcrumbs)): ?>
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
        'homeLink' => false,
        'tagName' => 'ul',
        'separator' => '',
        'activeLinkTemplate' => '<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
        'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
        'htmlOptions' => array('class' => 'breadcrumb')
    ));
    ?>
                    <!-- breadcrumbs -->
                <?php endif ?>

                <?php echo $content ?>

            </div><!--/.fluid-container-->
        </div>

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div id="footer-copyright" class="col-md-6">

                    </div> <!-- /span6 -->
                    <div id="footer-terms" class="col-md-6">
                        © Sistema de reservas ist 2014. 
                    </div> <!-- /.span6 -->
                </div> <!-- /row -->
            </div> <!-- /container -->
        </div>
    </body>
</html>
