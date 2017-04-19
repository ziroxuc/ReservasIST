<?php

/**
 * This is the model class for table "solicitud_contrato".
 *
 * The followings are the available columns in table 'solicitud_contrato':
 * @property integer $id
 * @property string $fecha_ingreso
 * @property string $fecha_cambio_estado
 * @property string $rut_empresa
 * @property string $nombre_empresa
 * @property string $nombre_contacto_emp
 * @property string $telefono_contacto_emp
 * @property integer $cantidad_trabajadores
 * @property string $fecha_solicitud
 * @property string $origen_emp
 * @property string $nombre_ejecutivo
 * @property string $rut_ejecutivo
 * @property string $rut_solicitante
 * @property string $estado
 * @property string $comentario
 * * @property string $codigo_actividad
 * * @property string $tipo_contrato
 * @property integer $cantidad_rechazada
 * @property string $comentario_fech_vali
 * @property string $mes_produccion
 * @property string $empresa_relacionada
 */
class SolicitudContrato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitud_contrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut_ejecutivo, rut_solicitante, estado, cantidad_rechazada,rut_empresa,nombre_empresa,nombre_contacto_emp,telefono_contacto_emp,cantidad_trabajadores,origen_emp,usuario_web,tipo_contrato', 'required'),
                        array('rut_ejecutivo','validateRutEjecutivo'),
                        array('rut_ejecutivo','validaEjecutivoActivo'),
                    
                        array('rut_empresa','validateRutEmpresa'),
                        array('nro_memo','addNumeroMemo'),
                        array('tipo_contrato','validateTipoContratoRut'),
                        array('comentario_fech_vali','verificaFechaValidacion'),
                        //array('vigencia', 'date', 'format' => 'yy-mm-dd', 'message' => 'La fecha parece inválida.'),
                    
                        //array('rut_ejecutivo', 'unique', 'attributeName'=>'rut_ejecutivo','className'=>'SolicitudContrato','allowEmpty'=>false),
                        //array('rut_empresa', 'unique', 'attributeName'=>'rut_empresa','className'=>'SolicitudContrato','allowEmpty'=>false),
                        array('nro_memo', 'length', 'max'=>10),
                        array('cantidad_trabajadores, cantidad_rechazada', 'numerical', 'integerOnly'=>true),
			array('fecha_ingreso, fecha_cambio_estado, fecha_solicitud,codigo_actividad', 'length', 'max'=>20),
			array('rut_empresa', 'length', 'max'=>12),
			array('nombre_contacto_emp,vigencia,rut_jv,nombre_jv,rut_sup,nombre_sup,', 'length', 'max'=>60),
			array('nombre_empresa', 'length', 'max'=>150),
			array('telefono_contacto_emp,empresa_relacionada', 'length', 'max'=>15),
			array('origen_emp, nombre_ejecutivo, rut_solicitante, estado', 'length', 'max'=>45),
			array('rut_ejecutivo,rut_jv,rut_sup', 'length', 'max'=>10),
			array('comentario,comentario_fech_vali,mes_produccion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_ingreso,codigo_actividad,tipo_contrato,fecha_cambio_estado, rut_empresa, nombre_empresa, nombre_contacto_emp,rut_jv,nombre_jv,rut_sup,nombre_sup, telefono_contacto_emp, cantidad_trabajadores, fecha_solicitud, origen_emp, nombre_ejecutivo, rut_ejecutivo, rut_solicitante, estado, comentario, cantidad_rechazada,vigencia,nro_memo,usuario_web', 'safe', 'on'=>'search'),
		);
	}
        
        public function validaEjecutivoActivo($attribute, $params) {
          
        $rut = $this->rut_ejecutivo;
        $id = $this->id;
        $sql="select estado from usuario where rut='$rut'";
        $estado=Yii::app()->db->createCommand($sql)->queryScalar();
        
         if($estado==="Inactivo"){
           $this->addError('rut_ejecutivo', 'Ejecutivo Inactivo.'.CHtml::link('Editar ahora',array('solicitudContrato/update','id'=>$id),array('style'=>'color:#0101DF;'))); 
         }  
        }
        
        
        public function addNumeroMemo($attribute, $params) {
        $estado = $this->estado;
        $nro_memo= $this->nro_memo;
         if($estado==="Completa" && ($nro_memo===null||(int)$nro_memo===0) ){
           $this->addError('nro_memo', 'Número de memo requerido.'); 
         }  
        }
        
         public function verificaFechaValidacion($attribute, $params) {
        $fechaValidacion = $this->fecha_cambio_estado;
        $idEmpresa=$this->id;
        $comentarioFecha=$this->comentario_fech_vali;
        
        $sql="select fecha_cambio_estado from solicitud_contrato where id='$idEmpresa'";
        $fechaValidacionDB=Yii::app()->db->createCommand($sql)->queryScalar();
        
        //$sql1="select comentario_fech_vali from solicitud_contrato where id='$idEmpresa'";
        //$comentarioFechDB=Yii::app()->db->createCommand($sql1)->queryScalar();
        
         if(!$this->isNewRecord){
            if($fechaValidacionDB!==$fechaValidacion) {
                if($comentarioFecha===" "||$comentarioFecha==null||$comentarioFecha===" ")
                $this->addError('comentario_fech_vali', 'Debe comentar porque cambio la fecha.');
             }
        
            }
        }
        
         public function validateTipoContratoRut($attribute, $params) {
             
        $tipoContrato= $this->tipo_contrato;
        $rutEmpresa=$this->rut_empresa;
        
        $sql="select tipo_contrato from solicitud_contrato where rut_empresa='$rutEmpresa'";
        $tipoContratoBD=Yii::app()->db->createCommand($sql)->queryScalar();
        
         if($tipoContrato===$tipoContratoBD&&$this->isNewRecord) {
           $this->addError('tipo_contrato', 'Ya existe este tipo de contrato para el rut '.$rutEmpresa.'.'); 
         }  
        }
         
        public function validateRutEmpresa($attribute, $params) {
        $data = explode('-', $this->rut_empresa);
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
            $this->addError('rut_empresa', 'Rut inválido.');
    }
    
    
    public function validateRutEjecutivo($attribute, $params) {
        $data = explode('-', $this->rut_ejecutivo);
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
            $this->addError('rut_ejecutivo', 'Rut inválido.');
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
			'id' => 'ID',
			'fecha_ingreso' => 'Fecha Ingreso',
			'fecha_cambio_estado' => 'Fecha validación',
			'rut_empresa' => 'Rut Empresa',
			'nombre_empresa' => 'Nombre Empresa',
			'nombre_contacto_emp' => 'Nombre Contacto',
			'telefono_contacto_emp' => 'Teléfono Contacto',
			'cantidad_trabajadores' => 'Cantidad Trabajadores',
			'fecha_solicitud' => 'Fecha Solicitud',
			'origen_emp' => 'Procedencia',
                        'rut_jv' => 'Rut Jefe de venta',
                        'nombre_jv' => 'Nombre Jefe de venta',
                        'rut_sup' => 'Rut supervisor',
                        'nombre_sup' => 'Nombre supervisor',
			'nombre_ejecutivo' => 'Nombre Ejecutivo',
			'rut_ejecutivo' => 'Rut Ejecutivo',
			'rut_solicitante' => 'Rut solicitante',
                        'usuario_web' => 'Usuario web',
			'estado' => 'Estado',
			'comentario' => 'Comentario',
			'cantidad_rechazada' => 'Cantidad Rechazada',
                        'vigencia' => 'Vigencia',
                        'nro_memo'=>'Número memo',
                        'codigo_actividad' => 'Código de actividad',
                        'tipo_contrato'=>'Tipo de contrato',
                        'comentario_fech_vali'=>'Comentario cambio fecha',
                        'mes_produccion'=>'Mes de producción',
                        'empresa_relacionada'=>'Empresa relacionada'
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

            $solicitante=Yii::app()->user->getState("rut");
            
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_cambio_estado',$this->fecha_cambio_estado,true);
		$criteria->compare('rut_empresa',$this->rut_empresa,true);
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('nombre_contacto_emp',$this->nombre_contacto_emp,true);
		$criteria->compare('telefono_contacto_emp',$this->telefono_contacto_emp,true);
		$criteria->compare('cantidad_trabajadores',$this->cantidad_trabajadores);
		$criteria->compare('fecha_solicitud',$this->fecha_solicitud,true);
		$criteria->compare('origen_emp',$this->origen_emp,true);
		$criteria->compare('nombre_ejecutivo',$this->nombre_ejecutivo,true);
		$criteria->compare('rut_ejecutivo',$this->rut_ejecutivo,true);
		$criteria->compare('rut_solicitante',$this->rut_solicitante,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('comentario',$this->comentario,true);
                $criteria->compare('rut_jv',$this->rut_jv,true);
                $criteria->compare('nombre_jv',$this->nombre_jv,true);
                $criteria->compare('rut_sup',$this->rut_sup,true);
                $criteria->compare('nombre_sup',$this->nombre_sup,true);
                $criteria->compare('comentario',$this->vigencia,true);
		$criteria->compare('cantidad_rechazada',$this->cantidad_rechazada);
                $criteria->compare('nro_memo',$this->nro_memo);
                $criteria->compare('codigo_actividad',$this->codigo_actividad);
                $criteria->compare('tipo_contrato',$this->tipo_contrato);
                $criteria->compare('comentario_fech_vali',$this->comentario_fech_vali);
                $criteria->compare('mes_produccion',$this->mes_produccion);
                $criteria->compare('empresa_relacionada',$this->empresa_relacionada);
                
                $criteria->order = 'id desc';
                
//                if(Yii::app()->user->getState("tipo")!="administrador"){
//                    $criteria->condition='rut_solicitante=:rut_solicitante';
//                    $criteria->params=array(':rut_solicitante'=>$solicitante);
                //}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SolicitudContrato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	} 
        
  
          public function getSup($rut_jv){
            $sql="select rut,CONCAT(nombre,' ', apellido) as names from usuario where rut_padre='$rut_jv' and estado='Activo'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","names");   
         }
         
          public function getEjecu($rut_sup){
            $sql="select rut,CONCAT(nombre,' ', apellido) as names from usuario where rut_padre='$rut_sup' and estado='Activo'";
            $list=Yii::app()->db->createCommand($sql)->queryAll();
            return CHtml::listData($list,"rut","names");   
         }
         
          public function getNombreJefVenta($rut_ejecutivo){
            
            $sql="select rut_padre from usuario where rut='$rut_ejecutivo'";
            $rut_sup =  Yii::app()->db->createCommand($sql)->queryScalar();
            
            $sql2="select rut_padre from usuario where rut='$rut_sup'";
            $rut_jv =  Yii::app()->db->createCommand($sql2)->queryScalar();
            
            $sql3="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut_jv'";
            $nombre_completo =  Yii::app()->db->createCommand($sql3)->queryScalar();
            return $nombre_completo;
        }
        
         public function getNombreSup($rut_ejecutivo){
            
             $sql="select rut_padre from usuario where rut='$rut_ejecutivo'";
            $rut_sup =  Yii::app()->db->createCommand($sql)->queryScalar();
            
            $sql="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut_sup'";
            $nombre_completo =  Yii::app()->db->createCommand($sql)->queryScalar();
            return $nombre_completo;
        }
        
        function dias_transcurridos($fecha_i,$fecha_f){
            
            $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
            $dias 	= abs($dias); $dias = floor($dias);		
            return $dias;
        }
        
        public function Alertas(){
            
            date_default_timezone_set("America/Santiago");
            $fechaHoy=date("Y-m-d");
            $user=  Yii::app()->user->getState("rut");
            $tipoUser=  Yii::app()->user->getState("tipo");
            $numeroDevueltas=0;
            $a= array();
            
            if($tipoUser=="jefe de venta"){
                $sql="select date(fecha_cambio_estado) as fechas from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_jv='$user' and
                            date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                $DevueltosFechas =  Yii::app()->db->createCommand($sql)->queryAll();  
                
            }elseif($tipoUser=="supervisor"){
                $sql="select date(fecha_cambio_estado) as fechas from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_sup='$user' and
                            date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                $DevueltosFechas =  Yii::app()->db->createCommand($sql)->queryAll();
                
            }elseif($tipoUser=="gerente"||$tipoUser=="administrador"){
                $sql="select date(fecha_cambio_estado) as fechas from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and
                            date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                $DevueltosFechas =  Yii::app()->db->createCommand($sql)->queryAll();
            }
             foreach($DevueltosFechas as $data){
                    $a[]=$data['fechas'];
                }
                foreach($a as $fecha){
                    $difDias=$this->dias_transcurridos($fecha, $fechaHoy);
                    if($difDias>=2){
                      $numeroDevueltas=$numeroDevueltas+1;
                    }
                }
            return $numeroDevueltas;
        }
        
        
}
