<script type="text/javascript">
      $(document).ready(function(){
       $("#errorSubmit").hide();
        $("#bonos-form").submit(function () {  
       if($("#Bonos_fecha1").val().length < 1||$("#Bonos_fecha2").val().length < 1) {  
       $("#errorSubmit").show(); 
           return false;
       }else{
           $("#errorSubmit").hide();
           return true;
       }     
      }); 
}); 
        </script>
<h3>Crear Bonos </h3>
<div style="height: 10px;"> </div>

    
<div class="alert alert-info">
        <p>A continuación se muestra el total de empresas y el total de adherentes Completos.</p>
</div>

<div class="alert alert-danger" id="errorSubmit">
    <p><b>ERROR:</b> Debe completar todos los campos.</p>
</div>
<div>
      <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'generarBonos',
            'method'=>'post',
             'id'=>'bonos-form',
             'enableAjaxValidation'=>false,
             'enableClientValidation'=>false,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             )
     )); ?>  
    
      <div>
          <?php echo $form->labelEx($bonos,'fecha1'); ?>
         <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$bonos,
                        'attribute'=>'fecha1',
                        'value'=>$bonos->fecha1,
                        'language' => 'es',
                        'htmlOptions' => array('readonly'=>"readonly",),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$bonos->fecha1,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha1',
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
     <?php echo $form->error($bonos,'fecha1'); ?>
     </div>
     <div class="row">
     <?php echo $form->labelEx($bonos,'fecha2'); ?>
     <?php 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$bonos,
                        'attribute'=>'fecha2',
                        'value'=>$bonos->fecha2,
                        'language' =>'es',
                        'htmlOptions' => array('readonly'=>"readonly",),
                        'options'=>array(
                        'autoSize'=>true,
                        'defaultDate'=>$bonos->fecha2,
                        'dateFormat'=>'yy-mm-dd',
                        'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                        'buttonImageOnly'=>false,
                        'buttonText'=>'fecha2',
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
     <?php echo $form->error($bonos,'fecha2'); ?>
     </div>
    <div class="row">       
         <?php echo CHtml::submitButton('Generar Bono',array('class'=>"btn btn-success",'id'=>'sbtBono','style'=>'margin-left:160px;margin-top:20px;')); ?>
 
    </div>    
    <?php $this->endWidget(); ?>
</div>     

