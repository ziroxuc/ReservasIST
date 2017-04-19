<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $rut
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $email
 * @property string $direccion
 * @property string $fecha_ingreso
 * @property string $fecha_salida
 * @property integer $estado
 * @property string $password
 * @property string $tipo
 * @property string $rut_padre
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, nombre, apellido, telefono, email, direccion, fecha_ingreso, password, tipo', 'required'),
			array('rut', 'validateRut'),
                        array('rut', 'unique', 'attributeName'=>'rut','className'=>'Usuario','allowEmpty'=>false),
			array('rut, rut_padre', 'length', 'max'=>10),
			array('nombre, apellido, email, direccion,estado', 'length', 'max'=>45),
			array('telefono', 'length', 'max'=>15),
			array('tipo', 'length', 'max'=>30),
			array('fecha_salida', 'safe'),
                        array('email','email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, nombre, apellido, telefono, email, direccion, fecha_ingreso, fecha_salida, estado, password, tipo, rut_padre,rut_jefe_sup,tipo_reservante', 'safe', 'on'=>'search'),
		);
	}
        
             public function validateRut($attribute, $params) {
        $data = explode('-', $this->rut);
        $evaluate = strrev($data[0]);
        $multiply = 2;
        $store = 0;
        for ($i = 0; $i < strlen($evaluate); $i++) {
            $store += $evaluate[$i] * $multiply;
            $multiply++;
            if ($multiply > 7)
                $multiply = 2;
        }
        isset($data[1]) ? $verifyCode = strtolower($data[1]) : $verifyCode = '';
        $result = 11 - ($store % 11);
        if ($result == 10)
            $result = 'k';
        if ($result == 11)
            $result = 0;
        if ($verifyCode != $result)
            $this->addError('rut', 'Rut inválido.');
    }
        
        

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'telefono' => 'Teléfono',
			'email' => 'Email',
			'direccion' => 'Dirección',
			'fecha_ingreso' => 'Inicio contrato',
			'fecha_salida' => 'Fecha desvinculación',
			'estado' => 'Estado',
			'password' => 'Password',
			'tipo' => 'Tipo',
			'rut_padre' => 'Dependencia',
                        'rut_jefe_sup' => 'Rut jefe Venta',
                        'tipo_reservante' => 'Tipo Reservante',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('rut_padre',$this->rut_padre,true);
                $criteria->compare('rut_jefe_sup',$this->rut_padre,true);
                $criteria->compare('tipo_reservante',$this->rut_padre,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function externo()
	{
            $solicitante=Yii::app()->user->getState("rut");
		// @todo Please modify the following code to remove attributes that should not be searched.
                
                $solicitante="Operaciones comerciales";
		$criteria=new CDbCriteria;   
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('rut_padre',$this->rut_padre,true);
                $criteria->compare('rut_jefe_sup',$this->rut_padre,true);
                $criteria->compare('tipo_reservante',$this->rut_padre,true);
                $criteria->order = 'fecha_ingreso desc';
                if(Yii::app()->user->getState("tipo")==="Operaciones comerciales"){
                    $criteria->condition='tipo!="supervisor"';
                    $criteria->addCondition('tipo!="jefe de venta"');
                    $criteria->addCondition('tipo!="administrador"');
                    $criteria->addCondition('tipo!="ejecutivo"');
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function validatePassword($password)
        {
            return $this->hashPassword($password)===$this->password;
        }
        
        public function hashPassword($password)
        {
            return sha1($password);
        }
         
          public function getEjecu($rut_sup){
            $sql="select rut,CONCAT(nombre,' ', apellido) as names from usuario where rut_padre='$rut_sup' and estado='Activo'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","names");   
         }
        
          public function getAllJV(){
            $sql="select rut,CONCAT(nombre,' ', apellido) as names from usuario where tipo='jefe de venta' and estado='Activo'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","names");   
         }
         
         public function getAllSup(){
            $sql="select rut,CONCAT(nombre,' ', apellido) as sup from usuario where tipo='supervisor' and estado='Activo'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","sup");   
         }
         
         public function getNombreSup($rutEjecutivo){
             
            $sql="select max(id) from historial_dependencias where rut='$rutEjecutivo'";
            $id=Yii::app()->db->createCommand($sql)->queryScalar();
            
            $sql2="select dependencia_sup from historial_dependencias where id='$id'";
            $nombreSupervisor=Yii::app()->db->createCommand($sql2)->queryScalar();
            
           //$datos=array('rutSup'=>$rutSupervisor,'nombreSup'=>$nombreSupervisor);
            if($nombreSupervisor)
                return $nombreSupervisor;
            else
                return " "; 
         }
         
         public function getNombreJV($rutEjecutivo){
             
            $sql="select max(id) from historial_dependencias where rut='$rutEjecutivo'";
            $id=Yii::app()->db->createCommand($sql)->queryScalar();
            
            $sql2="select dependencia_jv from historial_dependencias where id='$id'";
            $nombreJV=Yii::app()->db->createCommand($sql2)->queryScalar();
            
            if($nombreJV)
                return $nombreJV;
            else
                return " ";
         }
         
          public function getNombreDependencia($rut){
             
            $sql="select CONCAT(nombre,' ', apellido) as nombreSup from usuario where rut='$rut'";
            $nombreSupervisor=Yii::app()->db->createCommand($sql)->queryScalar();
            
            if($nombreSupervisor)
                return $nombreSupervisor;
            else
                return "Sin dependencia.";
         }
         
        
         
         
         
         
         
         
        
        
}
