<?php
class Bonos extends CFormModel{
    
public $mes;
public $ano;
public $fecha1;
public $fecha2;
  
    	public function rules()
	{
		return array(
                        array('mes', 'required'),
                        array('fecha1', 'required'),
                        array('fecha2', 'required'),
                        array('ano', 'required'),
			
			// name, email, subject and body are required
			//array('nombreJefeVenta, rutJefeVenta, nombreSupervisor, rutSupervisor', 'required'),
		);
	}
	public function attributeLabels()
	{
		return array(
                    'mes'=>'Mes',
                    'fecha1'=>'Fecha inicio',
                    'fecha2'=>'Fecha termino',
                    'ano'=>'Año',
		);
        }
        
        public function getMes($fecha){
            
         $mes=substr($fecha,5,-12);   
            
         if($mes=="01"){return "<b>Enero</b>";}
         elseif($mes=="02"){return "<b>Febrero</b>";}
         elseif($mes=="03"){return "<b>Marzo</b>";}
         elseif($mes=="04"){return "<b>Abril</b>";}
         elseif($mes=="05"){return "<b>Mayo</b>";}
         elseif($mes=="06"){return "<b>Junio</b>";}
         elseif($mes=="07"){return "<b>Julio</b>";}
         elseif($mes=="08"){return "<b>Agosto</b>";}
         elseif($mes=="09"){return "<b>Septiembre</b>";}
         elseif($mes=="10"){return "<b>Octubre</b>";}
         elseif($mes=="11"){return "<b>Noviembre</b>";}
         elseif($mes=="12"){return "<b>Diciembre</b>";}
         else{return $mes;}
         
        }
        
}
