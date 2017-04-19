<?php

/**
 * This is the model class for table "senaleticas".
 *
 * The followings are the available columns in table 'senaleticas':
 * @property integer $id
 * @property string $usuario_web
 * @property string $rut_jv
 * @property string $nombre_jv
 * @property string $rut_sup
 * @property string $nombre_sup
 * @property string $rut_eje
 * @property string $nombre_eje
 * @property string $nombre_empresa
 * @property string $rut_empresa
 * @property string $fecha_entrega
 * @property string $estado
 * @property string $nombre_recibe
 * @property string $cargo
 * @property string $telefono
 * @property string $fecha_recepcion
 * @property string $nombre_pago
 * @property string $telefono_pago
 */
class Senaleticas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'senaleticas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_web, estado', 'length', 'max'=>50),
			array('rut_jv, rut_sup, rut_eje', 'length', 'max'=>15),
			array('nombre_jv, nombre_sup, nombre_eje, nombre_empresa, rut_empresa, nombre_recibe, cargo, nombre_pago', 'length', 'max'=>100),
			array('telefono, telefono_pago', 'length', 'max'=>20),
			array('fecha_entrega, fecha_recepcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario_web, rut_jv, nombre_jv, rut_sup, nombre_sup, rut_eje, nombre_eje, nombre_empresa, rut_empresa, fecha_entrega, estado, nombre_recibe, cargo, telefono, fecha_recepcion, nombre_pago, telefono_pago', 'safe', 'on'=>'search'),
		);
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
			'usuario_web' => 'Usuario Web',
			'rut_jv' => 'Rut Jv',
			'nombre_jv' => 'Nombre Jv',
			'rut_sup' => 'Rut Sup',
			'nombre_sup' => 'Nombre Sup',
			'rut_eje' => 'Rut Eje',
			'nombre_eje' => 'Nombre Eje',
			'nombre_empresa' => 'Nombre Empresa',
			'rut_empresa' => 'Rut Empresa',
			'fecha_entrega' => 'Fecha Entrega',
			'estado' => 'Estado',
			'nombre_recibe' => 'Nombre quien recibe',
			'cargo' => 'Cargo',
			'telefono' => 'Teléfono',
			'fecha_recepcion' => 'Fecha Recepción',
			'nombre_pago' => 'Nombre quien paga',
			'telefono_pago' => 'Teléfono quien paga',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('usuario_web',$this->usuario_web,true);
		$criteria->compare('rut_jv',$this->rut_jv,true);
		$criteria->compare('nombre_jv',$this->nombre_jv,true);
		$criteria->compare('rut_sup',$this->rut_sup,true);
		$criteria->compare('nombre_sup',$this->nombre_sup,true);
		$criteria->compare('rut_eje',$this->rut_eje,true);
		$criteria->compare('nombre_eje',$this->nombre_eje,true);
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('rut_empresa',$this->rut_empresa,true);
		$criteria->compare('fecha_entrega',$this->fecha_entrega,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('nombre_recibe',$this->nombre_recibe,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fecha_recepcion',$this->fecha_recepcion,true);
		$criteria->compare('nombre_pago',$this->nombre_pago,true);
		$criteria->compare('telefono_pago',$this->telefono_pago,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Senaleticas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
      public function existenciaDeEntrega($rut_empresa){
          
          $sql="select rut_empresa from senaleticas where rut_empresa = '$rut_empresa'";
          $res = Yii::app()->db->createCommand($sql)->queryScalar();
          if($res!=false){
              return true;   
          }else{
              return false;
          }
    }
    
      public function verificaVencidas(){
          date_default_timezone_set('UTC');
          $fechaActual=date("Y-m-d");
          if(date("N")==1){
             $sql="update senaleticas set estado='Vencido' where $fechaActual >= DATE_ADD(fecha_entrega, INTERVAL 5 DAY)"; 
          }else{
             $sql="update senaleticas set estado='Vencido' where $fechaActual >= DATE_ADD(fecha_entrega, INTERVAL 3 DAY)"; 
          }
          Yii::app()->db->createCommand($sql)->execute();
    }
        
        
}
