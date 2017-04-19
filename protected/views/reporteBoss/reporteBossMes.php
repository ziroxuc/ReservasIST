
<script>
$(document).ready(function(){
   $("form#busca-form #Buscar_rut").rut();
   
});

</script>
<?php if(Yii::app()->user->getState("tipo")=="generico"){?>
     <div class="alert alert-success">
        <p>Seleccione un mes para visualizar el reporte.</p>
  </div> 
 <div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('reporteBoss/reporteBoss', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('reporteBoss/reporteBoss', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('reporteBoss/reporteBoss', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('reporteBoss/reporteBoss', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('reporteBoss/reporteBoss', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('reporteBoss/reporteBoss', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('reporteBoss/reporteBoss', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('reporteBoss/reporteBoss', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('reporteBoss/reporteBoss', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('reporteBoss/reporteBoss', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('reporteBoss/reporteBoss', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('reporteBoss/reporteBoss', 'mes'=>"12")); ?> </strong></div>
      </div>    
    
<?php }else{ ?>
 <div class="alert alert-warning" id="alertaCierres">
     <?php //$rut =  Yii::app()->user->getState("rut"); 
     $x = new FichaVisita();
     $b=$x->alertaAutoEvHoy();
     
     ?>
     <p>Usted tiene <?php echo $b; ?> autoevaluaciones con probabilidad de cierre hoy.  <?php echo CHtml::link('Ver posibles cierres en los proximos días.', array('fichaVisita/alertasCierres'),array('style'=>'float:right;')); ?> </p>
  </div> 
<div class="row">
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'buscar',
            'method'=>'post',
             'id'=>'busca-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             )
     )); ?>  
        <div class="col-xs-4">
		<?php echo $form->labelEx($buscar,'rut'); ?>
		<?php echo $form->textField($buscar,'rut',array('size'=>10,'maxlength'=>60,'class'=>'form-control')); ?>
                <?php
//                $accountStatus = array('rut_emp'=>'Rut empresa','nombre_emp'=>'Nombre empresa', 'rut_eje'=>'Rut Ejecutivo','nombre_eje'=>'Nombre Ejecutivo');
//                echo $form->radioButtonList($radio,'radio',$accountStatus,
//                array('separator'=>' ',
//                'labelOptions'=>array('style'=>'display:inline'), // add this code
//                ));
                ?>
		<?php echo $form->error($buscar,'rut'); ?>
            <br>
                <?php echo CHtml::submitButton('Buscar',array('class'=>"btn btn-success")); ?>
               <?php $this->endWidget(); ?>
        </div>
        <div class="col-xs-8">
            
            <?php
            $op=Yii::app()->user->getState("tipo");
            $func;
            if($op==="supervisor"){
                $func="reporteSupPorFechas";
            }else{
                $func="reporteGerenteGapPorFecha";
            }
            
            ?>
            
             <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>$func,
            'method'=>'get',
             'id'=>'fechas-modal-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             )
        )); ?> 
            
      <div class="col-xs-5">
          <?php echo $form->labelEx($modelfecha,'fecha_inicio'); ?>
         <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$modelfecha,
                        'attribute'=>'fecha_inicio',
                        'value'=>$modelfecha->fecha_inicio,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$modelfecha->fecha_inicio,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_inicio',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        //'minDate'=>'-3M', //fecha minima
                        //'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
     <?php echo $form->error($modelfecha,'fecha_inicio'); ?>
     </div>
     <div class="col-xs-5">
     <?php echo $form->labelEx($modelfecha,'fecha_fin'); ?>
     <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$modelfecha,
                        'attribute'=>'fecha_fin',
                        'value'=>$modelfecha->fecha_fin,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly"),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$modelfecha->fecha_fin,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha_fin                            ',
                        'selectOtherMonths'=>false,
                        'showAnim'=>'slide',
                        'showButtonPanel'=>true,
                        
                        'showOtherMonths'=>true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        //'minDate'=>'-3M', //fecha minima
                        //'maxDate'=> "1M", //fecha maxima
                        ),
                        )); ?>
     <?php echo $form->error($modelfecha,'fecha_fin'); ?>
     </div>
            <br><br><br><br>
          
         <?php echo CHtml::submitButton('Ver por rango de fechas',array('class'=>"btn btn-success",'id'=>'sbtFecha')); ?>
 
        </div>    
    <?php $this->endWidget(); ?>
        
</div>

 <div class="alert alert-success">
        <p>Seleccione un mes para visualizar el reporte.</p>
  </div> 

<?php 
      $user=Yii::app()->user->getState("tipo");
      $rutSup=Yii::app()->user->getState("rut");
      
if($rutSup==="8821211-8"||$user==="jefe de venta"){
?>
      <div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('reporteBoss/ReporteGerenteGap', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('reporteBoss/ReporteGerenteGap', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('reporteBoss/ReporteGerenteGap', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('reporteBoss/ReporteGerenteGap', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('reporteBoss/ReporteGerenteGap', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('reporteBoss/ReporteGerenteGap', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('reporteBoss/ReporteGerenteGap', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('reporteBoss/ReporteGerenteGap', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('reporteBoss/ReporteGerenteGap', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('reporteBoss/ReporteGerenteGap', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('reporteBoss/ReporteGerenteGap', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('reporteBoss/ReporteGerenteGap', 'mes'=>"12")); ?> </strong></div>
      </div> 
      
<?php }

elseif($user=="supervisor"){?>
<div class="row">
    </div>      
   
   <div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('reporteBoss/reporteSup', 'mes'=>"01",'rut_sup'=>"$rutSup")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('reporteBoss/reporteSup', 'mes'=>"02",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('reporteBoss/reporteSup', 'mes'=>"03",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('reporteBoss/reporteSup', 'mes'=>"04",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('reporteBoss/reporteSup', 'mes'=>"05",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('reporteBoss/reporteSup', 'mes'=>"06",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('reporteBoss/reporteSup', 'mes'=>"07",'rut_sup'=>"$rutSup")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('reporteBoss/reporteSup', 'mes'=>"08",'rut_sup'=>"$rutSup")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('reporteBoss/reporteSup', 'mes'=>"09",'rut_sup'=>"$rutSup")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('reporteBoss/reporteSup', 'mes'=>"10",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('reporteBoss/reporteSup', 'mes'=>"11",'rut_sup'=>"$rutSup")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('reporteBoss/reporteSup', 'mes'=>"12",'rut_sup'=>"$rutSup")); ?> </strong></div>
      </div>      
        

<?php }else{ ?>
    <div class="row">
            <div class="col-md-1"><strong> <?php echo CHtml::link('Enero', array('reporteBoss/reporteBoss', 'mes'=>"01")); ?> </strong></div> 
            <div class="col-md-1"><strong><?php echo CHtml::link('Febrero', array('reporteBoss/reporteBoss', 'mes'=>"02")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Marzo', array('reporteBoss/reporteBoss', 'mes'=>"03")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Abril', array('reporteBoss/reporteBoss', 'mes'=>"04")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Mayo', array('reporteBoss/reporteBoss', 'mes'=>"05")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Junio', array('reporteBoss/reporteBoss', 'mes'=>"06")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Julio', array('reporteBoss/reporteBoss', 'mes'=>"07")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Agosto', array('reporteBoss/reporteBoss', 'mes'=>"08")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Septiembre', array('reporteBoss/reporteBoss', 'mes'=>"09")); ?> </strong></div> 
            <div class="col-md-1"><strong> <?php echo CHtml::link('Octubre', array('reporteBoss/reporteBoss', 'mes'=>"10")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Noviembre', array('reporteBoss/reporteBoss', 'mes'=>"11")); ?> </strong></div>
            <div class="col-md-1"><strong> <?php echo CHtml::link('Diciembre', array('reporteBoss/reporteBoss', 'mes'=>"12")); ?> </strong></div>
      </div> 
<?php }?>
     <?php
     echo CHtml::link(CHtml::encode('Salir y cerrar sesión'), array('/site/logout'),array('class'=>'btn btn-danger','style'=>'float:right',));
}
     ?>






               
    

    



