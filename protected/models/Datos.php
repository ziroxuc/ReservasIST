<?php
class Datos extends CFormModel{
    
  public $nombreJefeVenta;
  public $rutJefeVenta;
  public $nombreSupervisor;
  public $rutSupervisor;
    
    	public function rules()
	{
		return array(
                        array('rut', 'required'),
			
			// name, email, subject and body are required
			//array('nombreJefeVenta, rutJefeVenta, nombreSupervisor, rutSupervisor', 'required'),
		);
	}
	public function attributeLabels()
	{
		return array(
                    'nombreJefeVenta'=>'Nombre Jefe de venta',
                    'rutJefeVenta'=>'Jefe de venta',
                    'nombreSupervisor'=>'Nombre Supervisor',
                    'rutSupervisor'=>'Supervisor',
		);
        }
        
         public function getJV(){
            $sql="select rut,CONCAT(nombre,' ', apellido) as names from usuario where tipo='jefe de venta'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","names");   
         }
         
         public function getSup(){
            $sql="select rut,CONCAT(nombre,' ', apellido) as sup from usuario where tipo='supervisor'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","sup");   
         }
        
}

