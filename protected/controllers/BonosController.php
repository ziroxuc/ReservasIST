<?php

class BonosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','jefesPorUsuario','admin','view','generarBonos','excel','detalleEjecutivo'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="administrador"',     
			),       
		);
	}
	
	public function actionIndex()
	{
            $bonos=new Bonos();
		$this->render('index',array('bonos'=>$bonos));
        }
        
        public function actionGenerarBonos(){
            //$mes=$_POST['Bonos']['mes'];
            if(isset($_GET['fecha1'])){
                $fecha1=$_GET['fecha1']." 00:00:00";
                $fecha2=$_GET['fecha2']." 23:59:59";
            }else{
                $fecha1=$_POST['Bonos']['fecha1']." 00:00:00";
                $fecha2=$_POST['Bonos']['fecha2']." 23:59:59";
            }
             $sql="SELECT u.rut FROM solicitud_contrato s,usuario u WHERE u.rut=s.rut_ejecutivo and u.estado='Activo' and tipo='ejecutivo' and (s.fecha_cambio_estado between '$fecha1' and '$fecha2' and s.estado='Completa') OR (s.mes_produccion=MONTH('$fecha2') and u.estado='Activo' and u.tipo='ejecutivo' and u.rut=s.rut_ejecutivo) group by u.rut ";
                $rut = Yii::app()->db->createCommand($sql)->queryAll();
                $a=array();
                $table=array();
                foreach($rut as $data){
                    
                    $a[]=$data['rut'];
                }
                foreach($a as $rutEjecutivos){
                 $sql1="select nombre_jv from solicitud_contrato where rut_ejecutivo='$rutEjecutivos'";
                 $nombres_jv=Yii::app()->db->createCommand($sql1)->queryScalar();   
                    
                 $sql2="select nombre_sup from solicitud_contrato where rut_ejecutivo='$rutEjecutivos'";
                 $nombres_sup=Yii::app()->db->createCommand($sql2)->queryScalar();
                 
                 $sql3="select CONCAT(nombre, ' ', apellido) As Nombre from usuario where rut='$rutEjecutivos'";
                 $nombres_ejecu=Yii::app()->db->createCommand($sql3)->queryScalar();
                 
                 $sql4="select fecha_ingreso from usuario where rut='$rutEjecutivos'";
                 $fechaIngreso=Yii::app()->db->createCommand($sql4)->queryScalar();
                 
                 $sql5="select count(rut_empresa) from solicitud_contrato where rut_ejecutivo='$rutEjecutivos' and (fecha_cambio_estado between '$fecha1' and '$fecha2' and estado='Completa') or (mes_produccion=MONTH('$fecha2') and rut_ejecutivo='$rutEjecutivos')";
                 $solCompletas=Yii::app()->db->createCommand($sql5)->queryScalar();
                 
                 $sql6="select count(rut_empresa) from solicitud_contrato where rut_ejecutivo='$rutEjecutivos' and (fecha_cambio_estado between '$fecha1' and '$fecha2' and estado='Devuelta') or (mes_produccion=MONTH('$fecha2') and rut_ejecutivo='$rutEjecutivos')";
                 $solDevueltas=Yii::app()->db->createCommand($sql6)->queryScalar();
                 
                 $sql7="select sum(cantidad_trabajadores) from solicitud_contrato where rut_ejecutivo='$rutEjecutivos' and (fecha_cambio_estado between '$fecha1' and '$fecha2' and estado='Completa') or (mes_produccion=MONTH('$fecha2') and rut_ejecutivo='$rutEjecutivos')";
                 $cantTrabajadores=Yii::app()->db->createCommand($sql7)->queryScalar();
                 
                 $mesActualContrato=$this->getMesActualContrato($fechaIngreso, $fecha2);
                 
                 $meta=$this->getMeta($fecha2, $fechaIngreso);
                
                 $bono=$this->getBono($fecha2, $fechaIngreso, $cantTrabajadores);
                 
                 $verEjecutivo=CHtml::link($nombres_ejecu,array('detalleEjecutivo','rut_ejecutivo'=>$rutEjecutivos,'fecha1'=>$fecha1,'fecha2'=>$fecha2));
                 
                 $table[]="<td>$nombres_jv</td><td>$nombres_sup</td><td>$verEjecutivo</td><td>$rutEjecutivos</td><td>$fechaIngreso</td><td>$mesActualContrato</td><td>$solDevueltas</td><td>$solCompletas</td><td>$cantTrabajadores</td><td>$meta</td><td>$bono</td>"; 
                 }
                 
                if(isset($_GET['excel'])&&$_GET['excel']==1){
                    $submes=substr(trim($fecha2), 5,-21);
                    $ano=substr(trim($fecha2), 0,-24);
                    $mes=$this->convertirMes($submes);
                    
                     Yii::app()->request->sendFile('Bonos '.$mes.' del '.$ano.'.xls', $this->renderPartial('excel',array(
                    'table'=>$table,
                    'fecha1'=>$fecha1,
                    'fecha2'=>$fecha2),true));
                }else{
                    $this->render('tablaBonos',array(
                    'table'=>$table,
                    'fecha1'=>$fecha1,
                    'fecha2'=>$fecha2,
                     ));  
                }    
        }
        public function convertirMes($mes){
            if($mes==="01"){return "Enero";
            }elseif($mes==="02"){return "Febrero";   
            }elseif($mes==="03"){return "Marzo";   
            }elseif($mes==="04"){return "Abril";   
            }elseif($mes==="05"){return "Mayo";   
            }elseif($mes==="06"){return "Junio";   
            }elseif($mes==="07"){return "Julio";   
            }elseif($mes==="08"){return "Agosto";   
            }elseif($mes==="09"){return "Septiembre";   
            }elseif($mes==="10"){return "Octubre";   
            }elseif($mes==="11"){return "Noviembre";   
            }elseif($mes==="12"){return "Diciembre";   
            }
        }
        
        public function getMesActualContrato($fechaIngreso,$fecha2){
            
            //selecciona la fecha final para el mes seleccionado
            (int)$mesInicial=  substr($fechaIngreso, 5,-3);
            (int)$mesFinal=  substr($fecha2, 5,-3);
            $numeroMes=$mesFinal-$mesInicial;
            return (int)$numeroMes+1;  
        }
        
        public function getMeta($fecha2,$fechaIngreso){
            
            $metaMes1=20;
            $metaMes2=40;
            $metaMes3=60;
            $metaNormal=80;
            
            $mesesContrato=$this->getMesActualContrato($fechaIngreso,$fecha2);
            if($mesesContrato==1){return $metaMes1;}  
            elseif($mesesContrato==2){return $metaMes2;}
            elseif($mesesContrato==3){return $metaMes3;}
            elseif($mesesContrato>=4){return $metaNormal;
            }     
        }
        
        public function getBono($fecha2,$fechaIngreso,$cantTrabajadores){
            $bono1=" $150.000";
            $bono2=" $75.000";
            
            $meta=$this->getMeta($fecha2, $fechaIngreso);
            if($cantTrabajadores>=$meta&&$meta==20){return $bono1;}
            elseif($cantTrabajadores>=$meta&&$meta==40){return $bono1;}
            elseif($cantTrabajadores>=$meta&&$meta==60){return $bono1;}
            elseif($cantTrabajadores>=$meta&&$meta>=80){return $bono2;}else{return "0";
            
            }  
        }
        
        public function verificaFechasOcupadas($mes,$ano){
            
            $sql="select ocupado from fechas_bonos where mes='$mes' and anio='$ano'";
            $ocupado=Yii::app()->db->createCommand($sql)->queryScalar();
            if($ocupado==false){
                return false;
            }else{return true;}  
        }
        
        public function actionDetalleEjecutivo($rut_ejecutivo,$fecha1,$fecha2){
          
            $sql="SELECT nombre_ejecutivo,rut_ejecutivo,nombre_empresa,rut_empresa,cantidad_trabajadores,fecha_cambio_estado,vigencia,estado,comentario FROM solicitud_contrato WHERE rut_ejecutivo = '$rut_ejecutivo' and fecha_cambio_estado between '$fecha1' and '$fecha2'";
            $detalle=Yii::app()->db->createCommand($sql)->queryAll();
            
            $this->render('detalleEjecutivo',array(
                'detalle'=>$detalle,
                'rut_ejecutivo'=>$rut_ejecutivo,
                'fecha1'=>$fecha1,
                'fecha2'=>$fecha2,
             )); 
        }
        
         
}
