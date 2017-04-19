<?php
class Buscar extends CFormModel{
    
  public $rut;
  public $op;
  
    	public function rules()
	{
		return array(
                        array('rut', 'required'),
                        array('op', 'required'),
			
			// name, email, subject and body are required
			//array('nombreJefeVenta, rutJefeVenta, nombreSupervisor, rutSupervisor', 'required'),
		);
	}
	public function attributeLabels()
	{
		return array(
                    'rut'=>'Rut a Buscar',
                    'op'=>'Opción',
		);
        }
}

