<?php
class RangoFechas extends CFormModel{
    
  public $fecha_inicio;
  public $fecha_fin;
  
    	public function rules()
	{
		return array(
                        array('$fecha_inicio,$fecha_fin', 'required'),
			
			// name, email, subject and body are required
			//array('nombreJefeVenta, rutJefeVenta, nombreSupervisor, rutSupervisor', 'required'),
		);
	}
	public function attributeLabels()
	{
		return array(
                    'fecha_inicio'=>'Desde',
                    'fecha_fin'=>'Hasta',
		);
        }
        
         public function getNro_memo(){
            $sql="SELECT nro_memo FROM solicitud_contrato WHERE nro_memo !=  '0' GROUP BY nro_memo";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"nro_memo","nro_memo");   
         }
        
}

