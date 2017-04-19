<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_rut;
    private $_tipo;


    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{            
            
                $rut=strtolower($this->username);
                
                $Rut = Usuario::model()->find(array(
                'select'=>'*',
                'condition'=>'rut=:rut and estado=:estado',
                'params'=>array(':rut'=>$rut,':estado'=>'Activo'),
                ));
                //$Rut=Usuario::model()->find('LOWER(rut)=?',array($rut));      
                    
		
		if($Rut===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$Rut->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
                        
                         Yii::app()->user->setState("tipo",$Rut->tipo);
                         Yii::app()->user->setState("nombre",$Rut->nombre);
                         Yii::app()->user->setState("rut",$Rut->rut);
                         Yii::app()->user->setState("apellido",$Rut->apellido);
                         
                         
                         $this->_rut = $Rut->rut;
                         $this->_tipo = $Rut->tipo;
                        
                }
 
		return !$this->errorCode;
	}
        
        public function getId() {
            return $this->_rut;
        }
        
}