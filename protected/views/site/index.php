<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Bienvenido <?php echo "<b>".Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido")."</b>" ?></h1>



