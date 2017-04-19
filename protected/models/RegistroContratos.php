<?php

/**
 * This is the model class for table "registro_contratos".
 *
 * The followings are the available columns in table 'registro_contratos':
 * @property integer $id
 * @property string $rut_empresa
 * @property string $nombre_empresa
 * @property string $rut_usuario
 * @property string $fecha
 * @property string $estado
 * @property string $comentario_fech_vali
 * @property string $tipo_solicitud
 * 
 */
class RegistroContratos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_contratos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut_empresa, nombre_empresa, rut_usuario, fecha, estado', 'required'),
			array('rut_empresa', 'length', 'max'=>12),
                        array('rut_usuario', 'length', 'max'=>150),
			array('nombre_empresa', 'length', 'max'=>255),
			array('fecha, estado', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rut_empresa, nombre_empresa, rut_usuario, fecha, estado,comentario_fech_vali,tipo_solicitud', 'safe', 'on'=>'search'),
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
			'rut_empresa' => 'Rut Empresa',
			'nombre_empresa' => 'Nombre Empresa',
			'rut_usuario' => 'Usuario Web',
                        ' tipo_solicitud' => 'Tipo de solicitud',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
                        'comentario_fech_vali'=>'Comentario cambio fecha',
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
		$criteria->compare('rut_empresa',$this->rut_empresa,true);
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('rut_usuario',$this->rut_usuario,true);
                $criteria->compare('tipo_solicitud',$this->tipo_solicitud,true);
                 
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);
                $criteria->compare('comentario_fech_vali',$this->comentario_fech_vali,true);
                
                $criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroContratos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
