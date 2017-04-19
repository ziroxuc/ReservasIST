<?php
class Memo extends CFormModel{
    
  public $numero_memo;
  
    	public function rules()
	{
		return array(
                        array('$numero_memo', 'required'),
			
			// name, email, subject and body are required
			//array('nombreJefeVenta, rutJefeVenta, nombreSupervisor, rutSupervisor', 'required'),
		);
	}
	public function attributeLabels()
	{
		return array(
                    'numero_memo'=>'Número memo',
		);
        }
        
         public function getNro_memo(){
            $sql="SELECT nro_memo FROM solicitud_contrato WHERE nro_memo !=  '0' GROUP BY nro_memo";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"nro_memo","nro_memo");   
         }
        
}

