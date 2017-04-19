<?php

/**
 * This is the model class for table "seguros".
 *
 * The followings are the available columns in table 'seguros':
 * @property integer $id
 * @property string $rut_jv
 * @property string $nombre_jv
 * @property string $rut_sup
 * @property string $nombre_sup
 * @property string $rut_ejecutivo
 * @property string $nombre_ejecutivo
 * @property integer $numero_certificado
 * @property string $fecha_vigencia
 * @property string $fecha_ingreso
 * @property string $nombre
 * @property integer $rut
 * @property string $digito
 * @property string $fecha_nacimiento
 * @property string $sexo
 * @property string $direccion
 * @property string $comuna
 * @property string $region
 * @property string $fono_particular
 * @property string $celular
 * @property string $email
 * @property integer $producto
 * @property integer $plan
 * @property integer $odonto_individual
 * @property integer $odonto_familiar
 * @property integer $renta_mensual
 * @property integer $interven_quirurgicas
 * @property integer $prima_mensual_uf
 * @property string $inicio_cobranza
 * @property string $via_pago
 * @property string $banco
 * @property string $nombre_banco
 * @property string $num_cta_corriente
 * @property string $num_tarjeta
 * @property integer $codigo_sucursal
 * @property integer $rut_empresa
 * @property string $digito_empresa
 * @property string $nombre_empresa
 * @property string $contacto_empresa
 * @property string $direccion_empresa
 * @property string $telefono_empresa
 * @property string $estado
 */
class Seguros extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
            return array(

                    array('rut_jv, nombre_jv, rut_sup, nombre_sup, rut_ejecutivo, nombre_ejecutivo, rut_empresa, nombre_empresa, contacto_empresa, direccion_empresa, telefono_empresa', 'required'),
                    array('numero_certificado, producto, plan, odonto_individual, odonto_familiar, renta_mensual, interven_quirurgicas, codigo_sucursal', 'numerical', 'integerOnly'=>true),
                    //array('rut','validateRut'),
                    //array('rut_empresa','validateRutEmpresa'),
                    array('rut_jv, rut_sup, rut_ejecutivo', 'length', 'max'=>15),
                    array('nombre_jv, nombre_sup, nombre_ejecutivo, comuna, region, fono_particular, celular, email, banco, nombre_banco, num_cta_corriente, num_tarjeta, digito_empresa, nombre_empresa, contacto_empresa, direccion_empresa, telefono_empresa, estado', 'length', 'max'=>45),
                    array('nombre, direccion', 'length', 'max'=>100),
                    array('digito, sexo', 'length', 'max'=>1),
                    array('via_pago', 'length', 'max'=>3),
                    array('fecha_vigencia, fecha_ingreso, fecha_nacimiento, inicio_cobranza', 'safe'),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, rut_jv, nombre_jv, rut_sup, nombre_sup, rut_ejecutivo, nombre_ejecutivo, numero_certificado, fecha_vigencia, fecha_ingreso, nombre, rut, digito, fecha_nacimiento, sexo, direccion, comuna, region, fono_particular, celular, email, producto, plan, odonto_individual, odonto_familiar, renta_mensual, interven_quirurgicas, prima_mensual_uf, inicio_cobranza, via_pago, banco, nombre_banco, num_cta_corriente, num_tarjeta, codigo_sucursal, rut_empresa, digito_empresa, nombre_empresa, contacto_empresa, direccion_empresa, telefono_empresa, estado', 'safe', 'on'=>'search'),
            );
	}
        
        
        public function validateRutEmpresa($attribute, $params) {
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
    
    public function validateRut($attribute, $params) {
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
			'rut_jv' => 'Rut Jefe de venta',
			'nombre_jv' => 'Nombre Jefe de venta',
			'rut_sup' => 'Rut Supupervisor',
			'nombre_sup' => 'Nombre Supervisor',
			'rut_ejecutivo' => 'Rut Ejecutivo',
			'nombre_ejecutivo' => 'Nombre Ejecutivo',
			'numero_certificado' => 'Numero Certificado',
			'fecha_vigencia' => 'Fecha Vigencia',
			'fecha_ingreso' => 'Fecha Ingreso',
			'nombre' => 'Nombre',
			'rut' => 'Rut',
			'digito' => 'Digito',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'sexo' => 'Sexo',
			'direccion' => 'Dirección',
			'comuna' => 'Comuna',
			'region' => 'Región',
			'fono_particular' => 'Fono Particular',
			'celular' => 'Celular',
			'email' => 'Email',
			'producto' => 'Producto',
			'plan' => 'Plan',
			'odonto_individual' => 'Odonto Individual',
			'odonto_familiar' => 'Odonto Familiar',
			'renta_mensual' => 'Renta Mensual',
			'interven_quirurgicas' => 'Intervención Quirurgicas',
			'prima_mensual_uf' => 'Prima Mensual Uf',
			'inicio_cobranza' => 'Inicio Cobranza',
			'via_pago' => 'Via Pago',
			'banco' => 'Banco',
			'nombre_banco' => 'Nombre Banco',
			'num_cta_corriente' => 'Num Cta Corriente',
			'num_tarjeta' => 'Num Tarjeta',
			'codigo_sucursal' => 'Codigo Sucursal',
			'rut_empresa' => 'Rut Empresa',
			'digito_empresa' => 'Digito Empresa',
			'nombre_empresa' => 'Nombre Empresa',
			'contacto_empresa' => 'Contacto Empresa',
			'direccion_empresa' => 'Dirección Empresa',
			'telefono_empresa' => 'Teléfono Empresa',
			'estado' => 'Estado',
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
		$criteria->compare('rut_ejecutivo',$this->rut_ejecutivo,true);
		$criteria->compare('nombre_ejecutivo',$this->nombre_ejecutivo,true);
		$criteria->compare('numero_certificado',$this->numero_certificado);
		$criteria->compare('fecha_vigencia',$this->fecha_vigencia,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('rut',$this->rut);
		$criteria->compare('digito',$this->digito,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('comuna',$this->comuna,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('fono_particular',$this->fono_particular,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('producto',$this->producto);
		$criteria->compare('plan',$this->plan);
		$criteria->compare('odonto_individual',$this->odonto_individual);
		$criteria->compare('odonto_familiar',$this->odonto_familiar);
		$criteria->compare('renta_mensual',$this->renta_mensual);
		$criteria->compare('interven_quirurgicas',$this->interven_quirurgicas);
		$criteria->compare('prima_mensual_uf',$this->prima_mensual_uf);
		$criteria->compare('inicio_cobranza',$this->inicio_cobranza,true);
		$criteria->compare('via_pago',$this->via_pago,true);
		$criteria->compare('banco',$this->banco,true);
		$criteria->compare('nombre_banco',$this->nombre_banco,true);
		$criteria->compare('num_cta_corriente',$this->num_cta_corriente,true);
		$criteria->compare('num_tarjeta',$this->num_tarjeta,true);
		$criteria->compare('codigo_sucursal',$this->codigo_sucursal);
		$criteria->compare('rut_empresa',$this->rut_empresa);
		$criteria->compare('digito_empresa',$this->digito_empresa,true);
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('contacto_empresa',$this->contacto_empresa,true);
		$criteria->compare('direccion_empresa',$this->direccion_empresa,true);
		$criteria->compare('telefono_empresa',$this->telefono_empresa,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Seguros the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
