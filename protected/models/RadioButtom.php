<?php
class RadioButtom extends CFormModel{
    
  public $radio;
  
    	public function rules()
	{
		return array(
                        array('radio', 'required'),
			
			// name, email, subject and body are required
			//array('nombreJefeVenta, rutJefeVenta, nombreSupervisor, rutSupervisor', 'required'),
		);
	}
	public function attributeLabels()
	{
		return array(
                    'radio'=>'',
		);
        }
}

