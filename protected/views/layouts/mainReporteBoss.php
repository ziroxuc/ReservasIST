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
        
     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/cssB/bootstrapBoss.min.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/cssB/bootstrap-responsive.min.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/cssB/grid.css" />
     <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/jquery.rut.js', CClientScript::POS_END );?>
         
    </head>
    <body>
      <div class="container">
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
