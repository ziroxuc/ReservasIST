<?php

/**
 * This is the model class for table "registro_reportes".
 *
 * The followings are the available columns in table 'registro_reportes':
 * @property integer $id
 * @property string $nombre_usuario
 * @property string $rut_usuario
 * @property string $tipo_usuario
 * @property string $fecha_conexion
 * @property integer $cantidad_conexiones
 * @property string $tipo_reporte
 */
class RegistroReportes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_reportes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_usuario, rut_usuario, tipo_usuario, fecha_conexion, cantidad_conexiones, tipo_reporte', 'required'),
			array('cantidad_conexiones', 'numerical', 'integerOnly'=>true),
			array('nombre_usuario', 'length', 'max'=>100),
			array('rut_usuario', 'length', 'max'=>15),
			array('tipo_usuario', 'length', 'max'=>20),
			array('tipo_reporte', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_usuario, rut_usuario, tipo_usuario, fecha_conexion, cantidad_conexiones, tipo_reporte', 'safe', 'on'=>'search'),
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
			'nombre_usuario' => 'Nombre Usuario',
			'rut_usuario' => 'Rut Usuario',
			'tipo_usuario' => 'Tipo Usuario',
			'fecha_conexion' => 'Fecha Conexion',
			'cantidad_conexiones' => 'Cantidad Conexiones',
			'tipo_reporte' => 'Tipo Reporte',
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
		$criteria->compare('nombre_usuario',$this->nombre_usuario,true);
		$criteria->compare('rut_usuario',$this->rut_usuario,true);
		$criteria->compare('tipo_usuario',$this->tipo_usuario,true);
		$criteria->compare('fecha_conexion',$this->fecha_conexion,true);
		$criteria->compare('cantidad_conexiones',$this->cantidad_conexiones);
		$criteria->compare('tipo_reporte',$this->tipo_reporte,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroReportes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function addRegistroReporte($tipoReporte){
            
            $regRepor= new RegistroReportes();
            $regRepor->nombre_usuario=Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido");
            $regRepor->rut_usuario=Yii::app()->user->getState("rut");
            $regRepor->tipo_usuario=Yii::app()->user->getState("tipo");
            $regRepor->fecha_conexion=new CDbExpression('NOW()');
            $regRepor->cantidad_conexiones=$regRepor->cantidad_conexiones+1;
            $regRepor->tipo_reporte=$tipoReporte;
            
            if($regRepor->save()){
                return true;
            }else{
                return false;  
            }
            
            
        }
}
