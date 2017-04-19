<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
  
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?>
                
                    <div class="usuario"> <?php if(isset(Yii::app()->user->isGuest)){
                       echo "<b>".Yii::app()->user->getState("tipo")." ".Yii::app()->user->getState("nombre")."</b>"." ".CHtml::link(CHtml::encode('Cerrar sesión'), array('/site/logout')); }
                       ?>
                   </div>

                </div>
            
         </div><!-- header -->   

	<div id="mainmenu">
		<?php 
                 if(Yii::app()->user->getState("tipo")==="administrador"){
                                    $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')),
				array('label'=>'Fichas de Visita', 'url'=>array('/fichaVisita/admin')),
                                array('label'=>'Usuarios', 'url'=>array('/usuario/admin')),
				),
		));
                                
                }else{
                $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')),
				array('label'=>'Empresas', 'url'=>array('/empresa/admin')),
				
				
			),
		));
                
                }
                ?>
	</div><!-- mainmenu -->
 
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
 
	<div class="clear"></div>

	<div id="footer">
		MJ Soluciones &copy; <?php echo date('Y'); ?> Para Vetlab.<br/>
		Todos los derechos reservados.<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
