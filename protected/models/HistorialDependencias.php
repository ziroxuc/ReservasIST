<?php

/**
 * This is the model class for table "historial_dependencias".
 *
 * The followings are the available columns in table 'historial_dependencias':
 * @property integer $id
 * @property string $rut
 * @property string $nombre
 * @property string $tipo
 * @property string $estado
 * @property string $fech_inicio_contr
 * @property string $fech_termino_contr
 * @property string $fech_inicio_depen
 * @property string $fech_termino_depen
 * @property string $dependencia_jv
 * @property string $rut_depen_jv
 * @property string $dependencia_sup
 * @property string $rut_depen_sup
 * @property integer $numero_cambios
 * @property string $usuario_web_modif
 * @property string $fech_usuario_web_modif
 */
class HistorialDependencias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_dependencias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, nombre, tipo, estado, fech_inicio_contr', 'required'),
			array('numero_cambios', 'numerical', 'integerOnly'=>true),
			array('rut, rut_depen_jv, rut_depen_sup', 'length', 'max'=>15),
			array('nombre, dependencia_jv, dependencia_sup', 'length', 'max'=>100),
			array('tipo, estado', 'length', 'max'=>20),
			array('usuario_web_modif', 'length', 'max'=>50),
			array('fech_termino_contr, fech_inicio_depen, fech_termino_depen, fech_usuario_web_modif', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rut, nombre, tipo, estado, fech_inicio_contr, fech_termino_contr, fech_inicio_depen, fech_termino_depen, dependencia_jv, rut_depen_jv, dependencia_sup, rut_depen_sup, numero_cambios, usuario_web_modif, fech_usuario_web_modif', 'safe', 'on'=>'search'),
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
			'rut' => 'Rut',
			'nombre' => 'Nombre',
			'tipo' => 'Tipo',
			'estado' => 'Estado',
			'fech_inicio_contr' => 'Fech Inicio Contr',
			'fech_termino_contr' => 'Fech Termino Contr',
			'fech_inicio_depen' => 'Fech Inicio Depen',
			'fech_termino_depen' => 'Termino Depen anterior',
			'dependencia_jv' => 'Dependencia Jv',
			'rut_depen_jv' => 'Rut Depen Jv',
			'dependencia_sup' => 'Dependencia Sup',
			'rut_depen_sup' => 'Rut Depen Sup',
			'numero_cambios' => 'Numero Cambios',
			'usuario_web_modif' => 'Usuario Web Modif',
			'fech_usuario_web_modif' => 'Fech Usuario Web Modif',
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
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fech_inicio_contr',$this->fech_inicio_contr,true);
		$criteria->compare('fech_termino_contr',$this->fech_termino_contr,true);
		$criteria->compare('fech_inicio_depen',$this->fech_inicio_depen,true);
		$criteria->compare('fech_termino_depen',$this->fech_termino_depen,true);
		$criteria->compare('dependencia_jv',$this->dependencia_jv,true);
		$criteria->compare('rut_depen_jv',$this->rut_depen_jv,true);
		$criteria->compare('dependencia_sup',$this->dependencia_sup,true);
		$criteria->compare('rut_depen_sup',$this->rut_depen_sup,true);
		$criteria->compare('numero_cambios',$this->numero_cambios);
		$criteria->compare('usuario_web_modif',$this->usuario_web_modif,true);
		$criteria->compare('fech_usuario_web_modif',$this->fech_usuario_web_modif,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialDependencias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
