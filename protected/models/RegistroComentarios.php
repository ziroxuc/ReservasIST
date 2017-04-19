<?php

/**
 * This is the model class for table "registro_comentarios".
 *
 * The followings are the available columns in table 'registro_comentarios':
 * @property integer $id
 * @property string $rut_jv
 * @property string $nombre_jv
 * @property string $rut_sup
 * @property string $nombre_sup
 * @property string $rut_eje
 * @property string $nombre_eje
 * @property string $rut_empresa
 * @property string $nombre_empresa
 * @property string $fecha_com_visita
 * @property string $com_visita
 * @property string $fecha_com_poscierre
 * @property string $com_poscierre
 */
class RegistroComentarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_comentarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut_jv, nombre_jv, rut_sup, nombre_sup, rut_eje, nombre_eje, rut_empresa, nombre_empresa, fecha_com_visita, com_visita, fecha_com_poscierre, com_poscierre', 'required'),
			array('rut_jv, rut_sup, rut_eje, rut_empresa', 'length', 'max'=>15),
			array('nombre_jv, nombre_sup, nombre_eje, nombre_empresa', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rut_jv, nombre_jv, rut_sup, nombre_sup, rut_eje, nombre_eje, rut_empresa, nombre_empresa, fecha_com_visita, com_visita, fecha_com_poscierre, com_poscierre', 'safe', 'on'=>'search'),
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
			'rut_jv' => 'Rut Jv',
			'nombre_jv' => 'Nombre Jv',
			'rut_sup' => 'Rut Sup',
			'nombre_sup' => 'Nombre Sup',
			'rut_eje' => 'Rut Eje',
			'nombre_eje' => 'Nombre Eje',
			'rut_empresa' => 'Rut Empresa',
			'nombre_empresa' => 'Nombre Empresa',
			'fecha_com_visita' => 'Fecha Com Visita',
			'com_visita' => 'Com Visita',
			'fecha_com_poscierre' => 'Fecha Com Poscierre',
			'com_poscierre' => 'Com Poscierre',
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
		$criteria->compare('rut_jv',$this->rut_jv,true);
		$criteria->compare('nombre_jv',$this->nombre_jv,true);
		$criteria->compare('rut_sup',$this->rut_sup,true);
		$criteria->compare('nombre_sup',$this->nombre_sup,true);
		$criteria->compare('rut_eje',$this->rut_eje,true);
		$criteria->compare('nombre_eje',$this->nombre_eje,true);
		$criteria->compare('rut_empresa',$this->rut_empresa,true);
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('fecha_com_visita',$this->fecha_com_visita,true);
		$criteria->compare('com_visita',$this->com_visita,true);
		$criteria->compare('fecha_com_poscierre',$this->fecha_com_poscierre,true);
		$criteria->compare('com_poscierre',$this->com_poscierre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroComentarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
