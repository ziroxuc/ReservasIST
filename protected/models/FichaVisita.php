<?php

/**
 * This is the model class for table "ficha_visita".
 *
* The followings are the available columns in table 'ficha_visita':
 * @property integer $id
 * @property string $estado_sistema
 * @property string $rut_jv
 * @property string $nombre_jv
 * @property string $rut_sup
 * @property string $nombre_sup
 * @property string $rut_eje
 * @property string $nombre_eje
 * @property string $rut_empresa
 * @property string $nombre_empresa
 * @property string $direccion_empresa
 * @property string $comuna_empresa
 * @property string $fono_empresa
 * @property string $nombre_contacto
 * @property string $fecha_visita
 * @property string $fecha_ingreso
 * @property string $usuario_web
 * @property integer $cantidad_trab
 * @property string $fech_pos_cierre
 * @property string $comentario
 * 
 * @property string $estado
 * @property string $fech_vencimiento
 * @property string $dias_restantes
 * @property integer $total_cumple
 * @property integer $total_nocumple
 * @property integer $total_noaplica
 * @property string $GTL1
 * @property string $GTL2
 * @property string $GTL3
 * @property string $GTL4
 * @property string $GTL5
 * @property string $GTL6
 * @property string $GTL7
 * @property string $GTL8
 * @property string $GTL9
 * 
 */
class FichaVisita extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ficha_visita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
            return array(
			array('rut_jv, nombre_jv, rut_sup, nombre_sup, rut_eje, nombre_eje, rut_empresa, nombre_empresa, direccion_empresa, comuna_empresa, fono_empresa, nombre_contacto, fecha_visita, fecha_ingreso, usuario_web, cantidad_trab,'
                            . 'GTL1,GTL2,GTL3,GTL4,GTL5,GTL6,GTL7,GTL8,GTL9,', 'required'),
                        array('rut_empresa','validateDuplicado'),
                        array('cantidad_trab', 'numerical', 'integerOnly'=>true),
			array('estado_sistema', 'length', 'max'=>30),
			array('rut_jv, rut_sup, rut_eje, rut_empresa, fono_empresa, estado', 'length', 'max'=>20),
			array('nombre_jv, nombre_sup, nombre_eje, nombre_empresa, direccion_empresa, comuna_empresa, nombre_contacto, usuario_web', 'length', 'max'=>100),
			array('dias_restantes', 'length', 'max'=>15),
			array('GTL1, GTL2, GTL3, GTL4, GTL5, GTL6, GTL7, GTL8, GTL9', 'length', 'max'=>10),
			array('fech_pos_cierre, comentario, fech_vencimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estado_sistema, rut_jv, nombre_jv, rut_sup, nombre_sup, rut_eje, nombre_eje, rut_empresa, nombre_empresa, direccion_empresa, comuna_empresa, fono_empresa, nombre_contacto, fecha_visita, fecha_ingreso, usuario_web, cantidad_trab, fech_pos_cierre, comentario, estado, fech_vencimiento, dias_restantes, total_cumple, total_nocumple, total_noaplica, GTL1, GTL2, GTL3, GTL4, GTL5, GTL6, GTL7, GTL8, GTL9', 'safe', 'on'=>'search'),
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
       public function validateDuplicado($attribute, $params) {
           if($this->isNewRecord){
           $rutEmpresa=str_replace(".","",$this->rut_empresa);
           
           $rutListo =  FichaVisita::model()->find(array(
	    'select'=>'rut_empresa',
	    'condition'=>'rut_empresa=:rut_empresa',
	    'params'=>array(':rut_empresa'=>$rutEmpresa),
	    ));
           
                if($rutListo!=null){
                     $this->addError('rut_empresa', 'El rut '.$rutEmpresa.' ya existe');

                }
           }else{}
    }
     public function validaRequerido($attribute, $params) {
           
           $check=$this->visita;
           $comentario=$this->visita_com;
           
           if($check=="Si"&&$comentario==""){
               $this->addError('visita_com', 'Debe escribir un comentario'); 
           }else{
               
           }  
    }
    
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'estado_sistema' => 'Estado en sistema',
			'rut_jv' => 'Rut Jv',
			'nombre_jv' => 'Nombre Jv',
			'rut_sup' => 'Rut Sup',
			'nombre_sup' => 'Nombre Sup',
			'rut_eje' => 'Rut Ejecutivo',
			'nombre_eje' => 'Nombre Ejecutivo',
			'rut_empresa' => 'Rut Empresa',
			'nombre_empresa' => 'Nombre Empresa',
			'direccion_empresa' => 'Direccion Empresa',
			'comuna_empresa' => 'Comuna Empresa',
			'fono_empresa' => 'Fono Empresa',
			'nombre_contacto' => 'Nombre Contacto',
			'fecha_visita' => 'Fecha Autoevaluación',
			'fecha_ingreso' => 'Fecha Ingreso',
			'usuario_web' => 'Usuario Web',
                        'cantidad_trab' => 'Cantidad trabajadores',
                        'fech_pos_cierre' => 'Fecha posible cierre',
			'comentario' => 'Comentario',
			'estado' => 'Estado',
			'fech_vencimiento' => 'Fecha vencimiento',
			'dias_restantes' => 'Dias restantes',
                        'total_cumple' => 'Total cumple',
			'total_nocumple' => 'Total no cumple',
			'total_noaplica' => 'Total no aplica',
			'GTL1' => 'GTL1',
			'GTL2' => 'GTL2',
			'GTL3' => 'GTL3',
			'GTL4' => 'GTL4',
			'GTL5' => 'GTL5',
			'GTL6' => 'GTL6',
			'GTL7' => 'GTL7',
			'GTL8' => 'GTL8',
			'GTL9' => 'GTL9',
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

               
                $rut=Yii::app()->user->getState('rut');
                
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
                $criteria->compare('estado_sistema',$this->estado_sistema,true);
		$criteria->compare('rut_jv',$this->rut_jv,true);
		$criteria->compare('nombre_jv',$this->nombre_jv,true);
		$criteria->compare('rut_sup',$this->rut_sup,true);
		$criteria->compare('nombre_sup',$this->nombre_sup,true);
		$criteria->compare('rut_eje',$this->rut_eje,true);
		$criteria->compare('nombre_eje',$this->nombre_eje,true);
		$criteria->compare('rut_empresa',$this->rut_empresa,true);
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true);
		$criteria->compare('direccion_empresa',$this->direccion_empresa,true);
		$criteria->compare('comuna_empresa',$this->comuna_empresa,true);
		$criteria->compare('fono_empresa',$this->fono_empresa,true);
		$criteria->compare('nombre_contacto',$this->nombre_contacto);
		$criteria->compare('fecha_visita',$this->fecha_visita,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('usuario_web',$this->usuario_web,true);
                $criteria->compare('cantidad_trab',$this->cantidad_trab,true);
                $criteria->compare('fech_pos_cierre',$this->fech_pos_cierre,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fech_vencimiento',$this->fech_vencimiento,true);
		$criteria->compare('dias_restantes',$this->dias_restantes,true);
                $criteria->compare('total_cumple',$this->total_cumple);
		$criteria->compare('total_nocumple',$this->total_nocumple);
		$criteria->compare('total_noaplica',$this->total_noaplica);
		$criteria->compare('GTL1',$this->GTL1,true);
		$criteria->compare('GTL2',$this->GTL2,true);
		$criteria->compare('GTL3',$this->GTL3,true);
		$criteria->compare('GTL4',$this->GTL4,true);
		$criteria->compare('GTL5',$this->GTL5,true);
		$criteria->compare('GTL6',$this->GTL6,true);
		$criteria->compare('GTL7',$this->GTL7,true);
		$criteria->compare('GTL8',$this->GTL8,true);
		$criteria->compare('GTL9',$this->GTL9,true);
               //$criteria->condition = 'rut_sup = :rut_sup';
               //$criteria->params = array(':rut_sup'=>'12747877-5');
                //$criteria->with =array('rut_sup');
                //$criteria->addSearchCondition('rut_sup',$this->rut_sup);
//                if(Yii::app()->user->getState('tipo')!="gerente"||Yii::app()->user->getState('tipo')!="administrador"){
//                    $criteria->addCondition("rut_sup = '$rut'");
//                }
               //$criteria->params=array('rut_sup'=>$rut);
                 $criteria->order = 'id DESC';
                 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        //'sort'=>$sort
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FichaVisita the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
         public function getNombreEjecu($rut_ejecutivo){
            
            $sql="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut_ejecutivo'";
            $nombre_completo =  Yii::app()->db->createCommand($sql)->queryScalar();
            return $nombre_completo;
        }
        
        public function getNombreJefVenta($rut_supervisor){
            
            $sql="select rut_padre from usuario where rut='$rut_supervisor'";
            $rut_jv =  Yii::app()->db->createCommand($sql)->queryScalar();
            
            $sql="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut_jv'";
            $nombre_completo =  Yii::app()->db->createCommand($sql)->queryScalar();
            return $nombre_completo;
        }
        
         public function getRutJV($rut_supervisor){
            
            $sql="select rut_padre from usuario where rut='$rut_supervisor' and estado='Activo'";
            $rut_jv =  Yii::app()->db->createCommand($sql)->queryScalar();
            return $rut_jv;
        }
        
         public function getNombreSup($rutEjecutivo){
             
            $sql="select rut_padre from usuario where rut='$rutEjecutivo' and estado='Activo'";
            $rutSupervisor=Yii::app()->db->createCommand($sql)->queryScalar();
             
            $sql2="select CONCAT(nombre,' ', apellido) as nombreSup from usuario where rut='$rutSupervisor' and estado='Activo'";
            $nombreSupervisor=Yii::app()->db->createCommand($sql2)->queryScalar();
            
           //$datos=array('rutSup'=>$rutSupervisor,'nombreSup'=>$nombreSupervisor);
            if($nombreSupervisor)
                return $nombreSupervisor;
            else
                return " "; 
            
             
         }
         public function getNombreJV($rutEjecutivo){
             
            $sql="select rut_padre from usuario where rut='$rutEjecutivo' and estado='Activo'";
            $rutSupervisor=Yii::app()->db->createCommand($sql)->queryScalar();
             
            $sql="select rut_padre from usuario where rut='$rutSupervisor' and estado='Activo'";
            $rutJV=Yii::app()->db->createCommand($sql)->queryScalar();
            
            $sql2="select CONCAT(nombre,' ', apellido) as nombreSup from usuario where rut='$rutJV' and estado='Activo'";
            $nombreJV=Yii::app()->db->createCommand($sql2)->queryScalar();
            
            if($nombreJV)
                return $nombreJV;
            else
                return " ";
         }  
         
         public function alertaAutoEvHoy(){
             
             date_default_timezone_set("America/Santiago");
            $fechaHoy=date("Y-m-d");
            $user=  Yii::app()->user->getState("rut");
            $tipoUser=  Yii::app()->user->getState("tipo");
            
            
            if($tipoUser=="jefe de venta"){
                $sql="select count(rut_empresa) as empresas from ficha_visita where date(fech_pos_cierre)='$fechaHoy' and rut_jv='$user'";
                $cantAE =  Yii::app()->db->createCommand($sql)->queryScalar();  
                
            }elseif($tipoUser=="supervisor"){
                $sql="select count(rut_empresa) as empresas from ficha_visita where date(fech_pos_cierre)='$fechaHoy' and rut_sup='$user'";
                $cantAE =  Yii::app()->db->createCommand($sql)->queryScalar();
                
            }elseif($tipoUser=="gerente"){
                $sql="select count(rut_empresa) as empresas from ficha_visita where date(fech_pos_cierre)='$fechaHoy'";
                $cantAE =  Yii::app()->db->createCommand($sql)->queryScalar();
            }
            
            return $cantAE;
         }
         
         public function sumarMes($fecha){
             date_default_timezone_set('UTC');
             $fech=date($fecha);
             $nuevafecha = strtotime ( '+30 day' , strtotime ( $fech ) ) ;
             $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
             return $nuevafecha;
         }
         
         function recortar_texto($texto, $limite=100){   
                $texto = trim($texto);
                $texto = strip_tags($texto);
                $tamano = strlen($texto);
                $resultado = '';
                if($tamano <= $limite){
                    return $texto;
                }else{
                    $texto = substr($texto, 0, $limite);
                    $palabras = explode(' ', $texto);
                    $resultado = implode(' ', $palabras);
                    $resultado .= '...';
                }   
                return $resultado;
    }

    public function verificaVencidas(){
          date_default_timezone_set('UTC');
          $fechaActual=date("Y-m-d");
          $sql="update ficha_visita set estado='Vencida' where date(fech_vencimiento)='$fechaActual'";
          Yii::app()->db->createCommand($sql)->execute();
    }
         
         
        
}
