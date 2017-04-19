<?php

class ReporteBossController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	 public $layout='//layouts/mainReporteBoss';

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
				'actions'=>array('index','create','update','delete','admin','view','update_estado','reporteBoss','reporteGerenteGap','reporteSup','detalleEjecutivos','reporteSup','reportePorFechas','buscar','reporteGerenteGapPorFecha','reporteSupPorFechas','DetalleEjecutivosPorFecha','verAccesos','descargaExcel','verDotacion','reporteEspecial','reporteNumerosEjecutivos','ranking','rankingMensual','verAlertas','rankingEmpresas'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="administrador"',
                               
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete','admin','view','update_estado','reporteBoss','reporteGerenteGap','detalleEjecutivos','reporteSup','reportePorFechas','buscar','reporteGerenteGapPorFecha','reporteSupPorFechas','detalleEjecutivosPorFecha','verAccesos','verDotacion','reporteEspecial','reporteNumerosEjecutivos','ranking','rankingMensual','verAlertas','rankingEmpresas','descargaExcel'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="gerente"',
                               
			),
                       array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete','admin','view','update_estado','reporteBoss','reporteGerenteGap','detalleEjecutivos','reporteSup','reportePorFechas'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="generico"',
                               
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete','admin','view','update_estado','reporteBoss','reporteGerenteGap','reporteSup','detalleEjecutivos','reportePorFechas','buscar','reporteGerenteGapPorFecha','reporteSupPorFechas','DetalleEjecutivosPorFecha','verAccesos','descargaExcel','verDotacion','reporteEspecial','reporteNumerosEjecutivos','ranking','rankingMensual','verAlertas','rankingEmpresas','descargaExcel'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="jefe de venta"',
                               
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete','admin','view','update_estado','reporteBoss','reporteGerenteGap','reporteSup','detalleEjecutivos','reporteSupPorFechas','detalleEjecutivosPorFecha','buscar','descargaExcel','verDotacion','verAlertas'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="supervisor"',
                               
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
         public function actionIndex()
	{
                $modelfecha=new RangoFechas();
                $buscar=new Buscar();
                $radio=new RadioButtom();
		$this->render('reporteBossMes',array(
                'modelfecha'=>$modelfecha,
                'radio'=>$radio,
                'buscar'=>$buscar    
                    ));
	}
        
        public function actionReporteEspecial(){
            $buscar=new Buscar();
            $this->render('reporteEspecial',array(
                'buscar'=>$buscar    
                    ));
        }
        
        public function actionReporteBoss($mes){
            
             if($mes==="01"){$month="Enero";
            }elseif($mes==="02"){$month="Febrero";   
            }elseif($mes==="03"){$month="Marzo";   
            }elseif($mes==="04"){$month="Abril";   
            }elseif($mes==="05"){$month="Mayo";   
            }elseif($mes==="06"){$month="Junio";   
            }elseif($mes==="07"){$month="Julio";   
            }elseif($mes==="08"){$month="Agosto";   
            }elseif($mes==="09"){$month="Septiembre";   
            }elseif($mes==="10"){$month="Octubre";   
            }elseif($mes==="11"){$month="Noviembre";   
            }elseif($mes==="12"){$month="Diciembre";   
            }
            //PRIMERA TABLA REPORTE GENERAL DE SDA Y ADH
            date_default_timezone_set('UTC');
            $year=date("Y"); 
            
             $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE estado='Completa' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year' and estado='Completa'";
           
            (int)$totalGeneralTodoSDACom=Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$totalGeneralTodoADHCom=Yii::app()->db->createCommand($plsql2)->queryScalar();
  
            //Acululado
            
            $xx="SELECT COUNT( rut_empresa ) FROM solicitud_contrato";
            $yy="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato";
            
            (int)$EmpAcumulado=   Yii::app()->db->createCommand($xx)->queryScalar();
            (int)$AdhAcumulado=   Yii::app()->db->createCommand($yy)->queryScalar();
            
                $this->render('reporteBoss',array(        
                     //total general todo
                 'totalGeneralTodoSDACom'=>$totalGeneralTodoSDACom,  
                 'totalGeneralTodoADHCom'=>$totalGeneralTodoADHCom,  
                 'EmpAcumulado'=>$EmpAcumulado,
                 'AdhAcumulado'=>$AdhAcumulado,   
                 'month'=>$month,          
             )); 
        }
        
        public function actionReporteGerenteGap($mes){
            
             //PRIMERA TABLA REPORTE GENERAL DE SDA Y ADH
            date_default_timezone_set('UTC');
            $year=date("Y"); 
            
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year' and (estado='Completa' or estado='Completa OPC')";
           
            (int)$totalGeneralTodoSDACom=Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$totalGeneralTodoADHCom=Yii::app()->db->createCommand($plsql2)->queryScalar();
  
            //Acululado
            
            $xx="SELECT COUNT( rut_empresa ) FROM solicitud_contrato";
            $yy="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato";
            
            (int)$EmpAcumulado=   Yii::app()->db->createCommand($xx)->queryScalar();
            (int)$AdhAcumulado=   Yii::app()->db->createCommand($yy)->queryScalar();
            //META CONSTANTE
            (int)$metaSDA=8*48;
            (int)$metaADH=121*48;
            
             if($mes==="01"){$month="Enero";
            }elseif($mes==="02"){$month="Febrero";   
            }elseif($mes==="03"){$month="Marzo";   
            }elseif($mes==="04"){$month="Abril";   
            }elseif($mes==="05"){$month="Mayo";   
            }elseif($mes==="06"){$month="Junio";   
            }elseif($mes==="07"){$month="Julio";   
            }elseif($mes==="08"){$month="Agosto";   
            }elseif($mes==="09"){$month="Septiembre";   
            }elseif($mes==="10"){$month="Octubre";   
            }elseif($mes==="11"){$month="Noviembre";   
            }elseif($mes==="12"){$month="Diciembre";   
            }
            //PRIMERA TABLA REPORTE GENERAL DE SDA Y ADH
            
            //FRANCISCO
            $plsqlFco1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
            
            (int)$fcoTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlFco1)->queryScalar();
            (int)$fcoTotalSDACompletas=    Yii::app()->db->createCommand($plsqlFco2)->queryScalar();
            (int)$fcoTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlFco3)->queryScalar();
            (int)$fcoTotalADHRevision=  Yii::app()->db->createCommand($plsqlFco4)->queryScalar();
            (int)$fcoTotalADHCompletas=  Yii::app()->db->createCommand($plsqlFco5)->queryScalar();
            (int)$fcoTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlFco6)->queryScalar();
            
            //EMMANUEL
            
            $plsqlEm1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
            
            (int)$EmTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlEm1)->queryScalar();
            (int)$EmTotalSDACompletas=    Yii::app()->db->createCommand($plsqlEm2)->queryScalar();
            (int)$EmTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlEm3)->queryScalar();
            (int)$EmTotalADHRevision=  Yii::app()->db->createCommand($plsqlEm4)->queryScalar();
            (int)$EmTotalADHCompletas=  Yii::app()->db->createCommand($plsqlEm5)->queryScalar();
            (int)$EmTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlEm6)->queryScalar();
            
            //ADOLFO
            $plsqlAd1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
            
            (int)$AdTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlAd1)->queryScalar();
            (int)$AdTotalSDACompletas=    Yii::app()->db->createCommand($plsqlAd2)->queryScalar();
            (int)$AdTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlAd3)->queryScalar();
            (int)$AdTotalADHRevision=  Yii::app()->db->createCommand($plsqlAd4)->queryScalar();
            (int)$AdTotalADHCompletas=  Yii::app()->db->createCommand($plsqlAd5)->queryScalar();
            (int)$AdTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlAd6)->queryScalar();
            
            //RESULTADO FINAL PRIMERA TABLA 
            
            $totalGeneralSDARevision=$fcoTotalSDAEnRevision+$EmTotalSDAEnRevision+$AdTotalSDAEnRevision;
            $totalGeneralSDACompletas=$fcoTotalSDACompletas+$EmTotalSDACompletas+$AdTotalSDACompletas;
            $totalGeneralSDADevueltas=$fcoTotalSDADevueltas+$EmTotalSDADevueltas+$AdTotalSDADevueltas;
            $totalGeneralADHRevision=$fcoTotalADHRevision+$EmTotalADHRevision+$AdTotalADHRevision;
            $totalGeneralADHCompleta=$fcoTotalADHCompletas+$EmTotalADHCompletas+$AdTotalADHCompletas;
            $totalGeneralADHDevueltas=$fcoTotalADHDevueltas+$EmTotalADHDevueltas+$AdTotalADHDevueltas;
            
            $totalGeneralTodoSDA=$totalGeneralSDARevision+$totalGeneralSDACompletas+$totalGeneralSDADevueltas;
            $totalGeneralTodoADH=$totalGeneralADHRevision+$totalGeneralADHCompleta+$totalGeneralADHDevueltas;
            
            //-------------------FIN PRIMERA TABLA---------------------
            
            
            //SEGUNDA TABLA PORCENTAJE DE APORTE A LA GERENCIA
            
            //factor totales de división
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
            (int)$factorTotalSDA=   Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$factorTotalADH=   Yii::app()->db->createCommand($plsql2)->queryScalar();
            
            //francisco
            $plsql1fco="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and rut_jv='8820971-0'";
            $plsql2fco="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and rut_jv='8820971-0'";
            (int)$fcoCompletasSDA= Yii::app()->db->createCommand($plsql1fco)->queryScalar();
            (int)$fcoCompletasADH= Yii::app()->db->createCommand($plsql2fco)->queryScalar();
            
            //Emmanuel
             $plsql1Em="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and rut_jv='14198477-2'";
            $plsql2Em="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and rut_jv='14198477-2'";
            (int)$EmCompletasSDA= Yii::app()->db->createCommand($plsql1Em)->queryScalar();
            (int)$EmCompletasADH= Yii::app()->db->createCommand($plsql2Em)->queryScalar();
            
            //Adolfo
            $plsql1Ad="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and rut_jv='16666225-7'";
            $plsql2Ad="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and rut_jv='16666225-7'";
            (int)$AdCompletasSDA= Yii::app()->db->createCommand($plsql1Ad)->queryScalar();
            (int)$AdCompletasADH= Yii::app()->db->createCommand($plsql2Ad)->queryScalar();
            
            if($factorTotalSDA>0 && $factorTotalADH){
                
                $PorcentajeAporteSDAfco=round(($fcoCompletasSDA*100)/$factorTotalSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeAporteADHfco=round(($fcoCompletasADH*100)/$factorTotalADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeAporteSDAEm=round(($EmCompletasSDA*100)/$factorTotalSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeAporteADHEm=round(($EmCompletasADH*100)/$factorTotalADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeAporteSDAAd=round(($AdCompletasSDA*100)/$factorTotalSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeAporteADHAd=round(($AdCompletasADH*100)/$factorTotalADH, 0, PHP_ROUND_HALF_EVEN);
                
            }else{
               $PorcentajeAporteSDAfco=0;
                $PorcentajeAporteADHfco=0;
                
                $PorcentajeAporteSDAEm=0;
                $PorcentajeAporteADHEm=0;
                
                $PorcentajeAporteSDAAd=0;
                $PorcentajeAporteADHAd=0; 
            }
            
            
            //------------FIN SEGUNDA TABLA PORCENTAJES DE APORTE---------
            
            
            //TABLA PORCENTAJE DE CUMPPLIMIENTO
            
                $PorcentajeCumpliSDAfco= round(($fcoCompletasSDA*100)/$metaSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeCumpliADHfco= round(($fcoCompletasADH*100)/$metaADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeCumpliSDAEm=round(($EmCompletasSDA*100)/$metaSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeCumpliADHEm=round(($EmCompletasADH*100)/$metaADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeCumpliSDAAd=round(($AdCompletasSDA*100)/$metaSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeCumpliADHAd=round(($AdCompletasADH*100)/$metaADH, 0, PHP_ROUND_HALF_EVEN);
     
            //-----------FIN TABLA PORCENTAJE DE CUMPPLIMIENTO---------------
            
            
              //Francisco 
          $sqlFcoSDA1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoSDA2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoSDA3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoSDA4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Rechazada' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoSDA5="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Renuncia' and MONTH(fecha_cambio_estado)= $mes";
          
          
          $sqlFcoADH1="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH3="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Rechazada' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Renuncia'  and MONTH(fecha_cambio_estado)= $mes";
          
          
         
          $sqlFco4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFco5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' and MONTH(fecha_cambio_estado)= $mes";
          
          (int)$fcoEnRevisionSDA=   Yii::app()->db->createCommand($sqlFcoSDA1)->queryScalar();
          (int)$fcoCompletasSDA=    Yii::app()->db->createCommand($sqlFcoSDA2)->queryScalar();
          (int)$fcoDevueltasSDA=  Yii::app()->db->createCommand($sqlFcoSDA3)->queryScalar();
          (int)$fcoRechazadaSDA=    Yii::app()->db->createCommand($sqlFcoSDA4)->queryScalar();
          (int)$fcoRenunciaSDA=  Yii::app()->db->createCommand($sqlFcoSDA5)->queryScalar();
          
          
          (int)$fcoEnRevisionADH=   Yii::app()->db->createCommand($sqlFcoADH1)->queryScalar();
          (int)$fcoCompletasADH=    Yii::app()->db->createCommand($sqlFcoADH2)->queryScalar();
          (int)$fcoDevueltasADH=  Yii::app()->db->createCommand($sqlFcoADH3)->queryScalar();
          (int)$fcoRechazadaADH=    Yii::app()->db->createCommand($sqlFcoADH4)->queryScalar();
          (int)$fcoRenunciaADH=  Yii::app()->db->createCommand($sqlFcoADH5)->queryScalar();
          
          
          (int)$fcoTotalEmpresas=  Yii::app()->db->createCommand($sqlFco4)->queryScalar();
          (int)$fcoTotalTrabajadores=  Yii::app()->db->createCommand($sqlFco5)->queryScalar();
                    if($fcoTotalEmpresas>0){
              
          (int)$porcenAceptacionFcoDiaz=($fcoCompletasSDA*100)/$fcoTotalEmpresas;
          
          $faltantesFcoSDA=$metaSDA-$fcoTotalEmpresas;
          $faltantesFcoADH=$metaADH-$fcoTotalTrabajadores;
          
          $porcenAceptacionFco= round($porcenAceptacionFcoDiaz, 0, PHP_ROUND_HALF_EVEN);
          }else{
              (int)$porcenAceptacionFco=0;
              (int)$faltantesFcoSDA=0;
              (int)$faltantesFcoADH=0;
          }
        //Emmanuel
          
          $sqlEm1SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm2SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm3SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm4SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Rechazada' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm5SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Renuncia' and MONTH(fecha_cambio_estado)= $mes";
   
          
          $sqlEm1ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm2ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm3ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm4ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Rechazada' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm5ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Renuncia'  and MONTH(fecha_cambio_estado)= $mes";
          
          
          
          $sqlEm4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' and MONTH(fecha_cambio_estado)= $mes"; 
          $sqlEm5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' and MONTH(fecha_cambio_estado)= $mes";
          (int)$EmEnRevisionSDA=   Yii::app()->db->createCommand($sqlEm1SDA)->queryScalar();
          (int)$EmCompletasSDA=    Yii::app()->db->createCommand($sqlEm2SDA)->queryScalar();
          (int)$EmDevueltasSDA=  Yii::app()->db->createCommand($sqlEm3SDA)->queryScalar();
          (int)$EmRechazadaSDA=  Yii::app()->db->createCommand($sqlEm4SDA)->queryScalar();
          (int)$EmRenunciaSDA=  Yii::app()->db->createCommand($sqlEm5SDA)->queryScalar();
          
          
          (int)$EmEnRevisionADH=   Yii::app()->db->createCommand($sqlEm1ADH)->queryScalar();
          (int)$EmCompletasADH=    Yii::app()->db->createCommand($sqlEm2ADH)->queryScalar();
          (int)$EmDevueltasADH=  Yii::app()->db->createCommand($sqlEm3ADH)->queryScalar();
          (int)$EmRechazadaADH=    Yii::app()->db->createCommand($sqlEm4ADH)->queryScalar();
          (int)$EmRenunciaADH=  Yii::app()->db->createCommand($sqlEm5ADH)->queryScalar();
          
          (int)$EmTotalEmpresas=  Yii::app()->db->createCommand($sqlEm4)->queryScalar();
          (int)$EmTotalTrabajadores=  Yii::app()->db->createCommand($sqlEm5)->queryScalar();
          
          $faltantesEmSDA=$metaSDA-$EmTotalEmpresas;
          $faltantesEmADH=$metaADH-$EmTotalTrabajadores;
          
          if($EmTotalEmpresas>0){
          (int)$porcenAceptacionEmSegura=($EmCompletasSDA*100)/$EmTotalEmpresas;
          (int)$porcenAceptacionEm= round($porcenAceptacionEmSegura, 0, PHP_ROUND_HALF_EVEN);
          }else{
              $porcenAceptacionEm=0;
              $porcenAceptacionEmSegura=0;
              $porcenAceptacionEm=0;
          }
          // Adolfo
          
          $sqlAd1SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd2SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd3SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd4SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Rechazada' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd5SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Renuncia' and MONTH(fecha_cambio_estado)= $mes";
        
          
          $sqlAd1ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd2ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado =  'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd3ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd4ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Rechazada' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd5ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Renuncia' and MONTH(fecha_cambio_estado)= $mes";
        
          $sqlAd4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' and MONTH(fecha_cambio_estado)= $mes"; 
          $sqlAd5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' and MONTH(fecha_cambio_estado)= $mes";
          (int)$AdIngresadas=   Yii::app()->db->createCommand($sqlAd1SDA)->queryScalar();
          (int)$AdCompletas=    Yii::app()->db->createCommand($sqlAd2SDA)->queryScalar();
          (int)$AdIncompletas=  Yii::app()->db->createCommand($sqlAd3SDA)->queryScalar();
          (int)$AdRechazada=    Yii::app()->db->createCommand($sqlAd4SDA)->queryScalar();
          (int)$AdRenuncia=  Yii::app()->db->createCommand($sqlAd5SDA)->queryScalar();
          
          (int)$AdIngresadasADH=   Yii::app()->db->createCommand($sqlAd1ADH)->queryScalar();
          (int)$AdCompletasADH=    Yii::app()->db->createCommand($sqlAd2ADH)->queryScalar();
          (int)$AdIncompletasADH=  Yii::app()->db->createCommand($sqlAd3ADH)->queryScalar();
          (int)$AdRechazadaADH=    Yii::app()->db->createCommand($sqlAd4ADH)->queryScalar();
          (int)$AdRenunciaADH=  Yii::app()->db->createCommand($sqlAd5ADH)->queryScalar();
          
          (int)$AdTotalEmpresas=  Yii::app()->db->createCommand($sqlAd4)->queryScalar();
          (int)$AdTotalTrabajadores=  Yii::app()->db->createCommand($sqlAd5)->queryScalar();
          
          $faltantesAdSDA=$metaSDA-$AdTotalEmpresas;
          $faltantesAdADH=$metaADH-$AdTotalTrabajadores;
         
          if($AdTotalEmpresas>0){
          (int)$porcenAceptacionAdGomez=($AdCompletas*100)/$AdTotalEmpresas;
           $porcenAceptacionAd= round($porcenAceptacionAdGomez, 0, PHP_ROUND_HALF_EVEN);
         }else{
            $porcenAceptacionAd=0;
            $porcenAceptacionAdGomez=0;
            $porcenAceptacionAd=0;
         }
            //SUPERVISORES
            
         
         //poner esta misma consulta de abajo en los demas jv
         
            $sql11="SELECT rut_sup FROM solicitud_contrato WHERE rut_jv = '8820971-0' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)=$year group by rut_sup";
            $nombres = Yii::app()->db->createCommand($sql11)->queryAll();
            $rutFco="8820971-0";
                foreach($nombres as $data){
                    $a[]=$data['rut_sup'];
                }
                if(empty($a)){
                    $a[]="";
                }
                
                foreach($a as $rut){
                 $sql1="select nombre_sup from solicitud_contrato where rut_sup='$rut'";
                 $nombres_sup=Yii::app()->db->createCommand($sql1)->queryScalar();
                 $sql2="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas = Yii::app()->db->createCommand($sql2)->queryScalar();
                 $sql3="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadCompletas = Yii::app()->db->createCommand($sql3)->queryScalar();
                 $sql4="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC')  and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadIncompletas = Yii::app()->db->createCommand($sql4)->queryScalar();
                 
                 $sql55="select count(rut_empresa) as q_empresas from solicitud_contrato where estado = 'Rechazada' and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadRechazada = Yii::app()->db->createCommand($sql55)->queryScalar();
                 $sql66="select count(rut_empresa) as q_empresas from solicitud_contrato where estado = 'Renuncia' and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadRenuncia = Yii::app()->db->createCommand($sql66)->queryScalar();
                 
                 $sql5="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadasADH = Yii::app()->db->createCommand($sql5)->queryScalar();
                 $sql6="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado =  'Completa' or estado='Completa OPC') and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletasADH = Yii::app()->db->createCommand($sql6)->queryScalar();
                 $sql7="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC')  and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletasADH = Yii::app()->db->createCommand($sql7)->queryScalar();
                 
                 $sql88="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado = 'Rechazada' and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadRechazadaADH = Yii::app()->db->createCommand($sql88)->queryScalar();
                 $sql99="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado = 'Renuncia' and rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadRenunciaADH = Yii::app()->db->createCommand($sql99)->queryScalar();
               
               
                 
                 $sql8="select count(rut_empresa) from solicitud_contrato where rut_sup='$rut' and rut_jv='$rutFco'  and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalEmpresas = Yii::app()->db->createCommand($sql8)->queryScalar();
                 $sql9="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rut' and rut_jv='$rutFco' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalTrabajadores = Yii::app()->db->createCommand($sql9)->queryScalar();
                 
                  $tableFco[]=
                         "<td>$nombres_sup</td>"
                         . "<td>$cantidadTotalEmpresas</td>"
                         . "<td>$cantidadTotalTrabajadores</td>"
                         . "<td>$cantidadIngresadas</td>"
                         . "<td>$cantidadIngresadasADH</td>"
                         . "<td>$cantidadCompletas</td>"
                         . "<td>$cantidadCompletasADH</td>"
                         . "<td>$cantidadIncompletas</td>"
                         . "<td>$cantidadIncompletasADH</td>" 
                         
                         . "<td>$cantidadRechazada</td>"
                         . "<td>$cantidadRechazadaADH</td>"
                         . "<td>$cantidadRenuncia</td>"
                         . "<td>$cantidadRenunciaADH</td>"  
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/reporteSup','mes'=>$mes, 'rut_sup'=>$rut),array('class'=>'btn btn-xs btn-success'))."</td>";
                }
                 
                 //tabla Emmanuel

                $rutEmanu='14198477-2';
        $sql111="SELECT rut_sup FROM solicitud_contrato WHERE rut_jv = '$rutEmanu' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)=$year group by rut_sup";
                $rutEm = Yii::app()->db->createCommand($sql111)->queryAll();
                
                $a2=array();
                $tableEmm=array();
                foreach($rutEm as $data2){
                    $a2[]=$data2['rut_sup'];
                }
                  if(empty($a2)){
                    $a2[]="";
                }
                foreach($a2 as $rutEm1){
                 $sql12="select nombre_sup from solicitud_contrato where rut_sup='$rutEm1'";
                 $nombres_sup2=Yii::app()->db->createCommand($sql12)->queryScalar();
                 
                 $sql22="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas2 = Yii::app()->db->createCommand($sql22)->queryScalar();
                 $sql32="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas2 = Yii::app()->db->createCommand($sql32)->queryScalar();
                 $sql42="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas2 = Yii::app()->db->createCommand($sql42)->queryScalar();
                 
                 $sql422="select count(rut_empresa) as q_empresas from solicitud_contrato where estado = 'Rechazada' and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadRechazada2 = Yii::app()->db->createCommand($sql422)->queryScalar();
                 $sql433="select count(rut_empresa) as q_empresas from solicitud_contrato where estado = 'Renuncia' and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadRenuncia2 = Yii::app()->db->createCommand($sql433)->queryScalar();
                 
                 
                 
                 
                 $sql52="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas2ADH = Yii::app()->db->createCommand($sql52)->queryScalar();
                 $sql62="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas2ADH = Yii::app()->db->createCommand($sql62)->queryScalar();
                 $sql72="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas2ADH = Yii::app()->db->createCommand($sql72)->queryScalar();
                 
                 $sql88="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado = 'Rechazada' and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadRechazada2ADH = Yii::app()->db->createCommand($sql88)->queryScalar();
                 $sql99="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado = 'Renuncia' and rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadRenuncia2ADH = Yii::app()->db->createCommand($sql99)->queryScalar();
                 
                 
                 $sql82="select count(rut_empresa) from solicitud_contrato where rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalEmpresas2 = Yii::app()->db->createCommand($sql82)->queryScalar();
                 $sql92="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rutEm1' and rut_jv='$rutEmanu' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalTrabajadores2 = Yii::app()->db->createCommand($sql92)->queryScalar(); 
                  $tableEmm[]=
                         "<td>$nombres_sup2</td>"
                         . "<td>$cantidadTotalEmpresas2</td>"
                         . "<td>$cantidadTotalTrabajadores2</td>"
                         . "<td>$cantidadIngresadas2</td>"
                         . "<td>$cantidadIngresadas2ADH</td>"
                         . "<td>$cantidadCompletas2</td>"
                         . "<td>$cantidadCompletas2ADH</td>"
                         . "<td>$cantidadIncompletas2</td>"
                         . "<td>$cantidadIncompletas2ADH</td>" 
                         
                         . "<td>$cantidadRechazada2</td>"
                         . "<td>$cantidadRechazada2ADH</td>"
                         . "<td>$cantidadRenuncia2</td>"
                         . "<td>$cantidadRenuncia2ADH</td>"  
                          
                          . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/reporteSup','mes'=>$mes, 'rut_sup'=>$rutEm1),array('class'=>'btn btn-xs btn-success'))."</td>";
                }
          
                 //tabla Adolfo
                $rutAdolfo='16666225-7';
                $sql1Adol="SELECT rut_sup FROM solicitud_contrato WHERE rut_jv = '$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)=$year group by rut_sup";
             
                $rutAdo1 = Yii::app()->db->createCommand($sql1Adol)->queryAll();
                $a3=array();
                $tableAdolfo=array();
                foreach($rutAdo1 as $data3){
                    $a3[]=$data3['rut_sup'];
                }
                  if(empty($a3)){
                    $a3[]="";
                }
                foreach($a3 as $rutAdo2){
                    
                 $sql13="select nombre_sup from solicitud_contrato where rut_sup='$rutAdo2'";
                 $nombres_sup3=Yii::app()->db->createCommand($sql13)->queryScalar();
                 $sql23="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                (int) $cantidadIngresadas3 = Yii::app()->db->createCommand($sql23)->queryScalar();
                 $sql33="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas3 = Yii::app()->db->createCommand($sql33)->queryScalar();
                 $sql43="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas3 = Yii::app()->db->createCommand($sql43)->queryScalar();
                 
                 $sql522="select count(rut_empresa) as q_empresas from solicitud_contrato where estado = 'Rechazada' and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadRechazada3 = Yii::app()->db->createCommand($sql522)->queryScalar();
                 $sql533="select count(rut_empresa) as q_empresas from solicitud_contrato where estado = 'Renuncia' and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int) $cantidadRenuncia3 = Yii::app()->db->createCommand($sql533)->queryScalar();
                 
                 $sql52="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas3ADH = Yii::app()->db->createCommand($sql52)->queryScalar();
                 $sql62="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas3ADH = Yii::app()->db->createCommand($sql62)->queryScalar();
                 $sql72="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas3ADH = Yii::app()->db->createCommand($sql72)->queryScalar();
                 $sql83="select count(rut_empresa) from solicitud_contrato where rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 
                 $sql883="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado = 'Rechazada' and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadRechazada3ADH = Yii::app()->db->createCommand($sql883)->queryScalar();
                 $sql993="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado = 'Renuncia' and rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadRenuncia3ADH = Yii::app()->db->createCommand($sql993)->queryScalar();
                 
                 
                 
                 (int)$cantidadTotalEmpresas3 = Yii::app()->db->createCommand($sql83)->queryScalar();
                 $sql93="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rutAdo2' and rut_jv='$rutAdolfo' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalTrabajadores3 = Yii::app()->db->createCommand($sql93)->queryScalar();
                 
                   $tableAdolfo[]=
                         "<td>$nombres_sup3</td>"
                         . "<td>$cantidadTotalEmpresas3</td>"
                         . "<td>$cantidadTotalTrabajadores3</td>"
                         . "<td>$cantidadIngresadas3</td>"
                         . "<td>$cantidadIngresadas3ADH</td>"
                         . "<td>$cantidadCompletas3</td>"
                         . "<td>$cantidadCompletas3ADH</td>"
                         . "<td>$cantidadIncompletas3</td>"
                         . "<td>$cantidadIncompletas3ADH</td>" 
                         . "<td>$cantidadRechazada3</td>"
                         . "<td>$cantidadRechazada3ADH</td>"
                         . "<td>$cantidadRenuncia3</td>"
                         . "<td>$cantidadRenuncia3ADH</td>"
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/reporteSup','mes'=>$mes, 'rut_sup'=>$rutAdo2),array('class'=>'btn btn-xs btn-success'))."</td>";
                }
                
                $this->render('reporteGerenteGap',array(
                //PRIMERA TABLA FCO

                'metaADH'=>$metaADH, 
                'metaSDA'=>$metaSDA,  
                     
                'fcoTotalSDAEnRevision'=>$fcoTotalSDAEnRevision, 
                'fcoTotalSDACompletas'=>$fcoTotalSDACompletas,     
                'fcoTotalSDADevueltas'=>$fcoTotalSDADevueltas,
                'fcoTotalADHRevision'=>$fcoTotalADHRevision,
                'fcoTotalADHCompletas'=>$fcoTotalADHCompletas,
                'fcoTotalADHDevueltas'=>$fcoTotalADHDevueltas,
                     //EMMANUEL
                'EmTotalSDAEnRevision'=>$EmTotalSDAEnRevision, 
                'EmTotalSDACompletas'=>$EmTotalSDACompletas,     
                'EmTotalSDADevueltas'=>$EmTotalSDADevueltas,
                'EmTotalADHRevision'=>$EmTotalADHRevision,
                'EmTotalADHCompletas'=>$EmTotalADHCompletas,
                'EmTotalADHDevueltas'=>$EmTotalADHDevueltas,
                          //ADOLGO
                'AdTotalSDAEnRevision'=>$AdTotalSDAEnRevision, 
                'AdTotalSDACompletas'=>$AdTotalSDACompletas,     
                'AdTotalSDADevueltas'=>$AdTotalSDADevueltas,
                'AdTotalADHRevision'=>$AdTotalADHRevision,
                'AdTotalADHCompletas'=>$AdTotalADHCompletas,
                'AdTotalADHDevueltas'=>$AdTotalADHDevueltas,
                     //RESULTADOS
                'totalGeneralSDARevision'=>$totalGeneralSDARevision, 
                'totalGeneralSDACompletas'=>$totalGeneralSDACompletas,     
                'totalGeneralSDADevueltas'=>$totalGeneralSDADevueltas,
                'totalGeneralADHRevision'=>$totalGeneralADHRevision,
                'totalGeneralADHCompleta'=>$totalGeneralADHCompleta,
                'totalGeneralADHDevueltas'=>$totalGeneralADHDevueltas,
                     //SEGUNDA TABLA PORCENTAJE APORTE GERENCIA
                'factorTotalSDA'=>$factorTotalSDA, 
                'factorTotalADH'=>$factorTotalADH,     
                'fcoCompletasSDA'=>$fcoCompletasSDA,
                'fcoCompletasADH'=>$fcoCompletasADH,
                'EmCompletasSDA'=>$EmCompletasSDA,
                'EmCompletasADH'=>$EmCompletasADH, 
                     
                'AdCompletasSDA'=>$AdCompletasSDA,
                'AdCompletasADH'=>$AdCompletasADH,
                     //PORCENTAJES CUMPLIMIENTO
                'PorcentajeAporteSDAfco'=>$PorcentajeAporteSDAfco, 
                'PorcentajeAporteADHfco'=>$PorcentajeAporteADHfco,     
                'PorcentajeAporteSDAEm'=>$PorcentajeAporteSDAEm,
                'PorcentajeAporteADHEm'=>$PorcentajeAporteADHEm,
                'PorcentajeAporteSDAAd'=>$PorcentajeAporteSDAAd,
                'PorcentajeAporteADHAd'=>$PorcentajeAporteADHAd,
                     
                     //porcentajes 
                'PorcentajeCumpliSDAfco'=>$PorcentajeCumpliSDAfco, 
                'PorcentajeCumpliADHfco'=>$PorcentajeCumpliADHfco,     
                'PorcentajeCumpliSDAEm'=>$PorcentajeCumpliSDAEm,
                'PorcentajeCumpliADHEm'=>$PorcentajeCumpliADHEm,
                'PorcentajeCumpliSDAAd'=>$PorcentajeCumpliSDAAd,
                'PorcentajeCumpliADHAd'=>$PorcentajeCumpliADHAd,
                     
                 //SUPERVISORES
                 'tableFco'=>$tableFco,
                 'tableEmm'=>$tableEmm,
                 'tableAdolfo'=>$tableAdolfo,
                 'month'=>$month,
                 //Francisco
                 'fcoEnRevisionSDA'=>$fcoEnRevisionSDA,
                 'fcoCompletasSDA'=>$fcoCompletasSDA,
                 'fcoDevueltasSDA'=>$fcoDevueltasSDA,
                 'fcoEnRevisionADH'=>$fcoEnRevisionADH,
                 'fcoCompletasADH'=>$fcoCompletasADH,
                 'fcoDevueltasADH'=>$fcoDevueltasADH,
                    
                 'fcoRechazadaSDA'=>$fcoRechazadaSDA,
                 'fcoRechazadaADH'=>$fcoRechazadaADH,
                 'fcoRenunciaSDA'=>$fcoRenunciaSDA,
                 'fcoRenunciaADH'=>$fcoRenunciaADH,
                     
                 'fcoTotalEmpresas'=>$fcoTotalEmpresas,
                 'fcoTotalTrabajadores'=>$fcoTotalTrabajadores,
                 'faltantesFcoSDA'=>$faltantesFcoSDA,
                 'faltantesFcoADH'=>$faltantesFcoADH,
                 //emmanuel
                 'EmEnRevisionSDA'=>$EmEnRevisionSDA,
                 'EmCompletasSDA'=>$EmCompletasSDA,
                 'EmDevueltasSDA'=>$EmDevueltasSDA,
                 'EmEnRevisionADH'=>$EmEnRevisionADH,
                 'EmCompletasADH'=>$EmCompletasADH,
                 'EmDevueltasADH'=>$EmDevueltasADH,
                    
                 'EmRechazadaSDA'=>$EmRechazadaSDA,
                 'EmRenunciaSDA'=>$EmRenunciaSDA,
                 'EmRechazadaADH'=>$EmRechazadaADH,
                 'EmRenunciaADH'=>$EmRenunciaADH,
                    
                 'EmTotalEmpresas'=>$EmTotalEmpresas,
                 'EmTotalTrabajadores'=>$EmTotalTrabajadores,
                 'faltantesEmSDA'=>$faltantesFcoSDA,
                 'faltantesEmADH'=>$faltantesFcoADH,
                 //Adolfo        
                 'AdIngresadas'=>$AdIngresadas,
                 'AdCompletas'=>$AdCompletas,
                 'AdIncompletas'=>$AdIncompletas,
                 'AdIngresadasADH'=>$AdIngresadasADH,
                 'AdCompletasADH'=>$AdCompletasADH,
                 'AdRechazada'=>$AdRechazada,
                 'AdRenuncia'=>$AdRenuncia,
                 'AdRechazadaADH'=>$AdRechazadaADH,
                 'AdRenunciaADH'=>$AdRenunciaADH,  
                 
                 'AdIncompletasADH'=>$AdIncompletasADH,
                 'AdTotalEmpresas'=>$AdTotalEmpresas,
                 'AdTotalTrabajadores'=>$AdTotalTrabajadores,
                 'faltantesAdSDA'=>$faltantesAdSDA,
                 'faltantesAdADH'=>$faltantesAdADH, 
                 //TOTALES
                 //'porcentajeTotal_empFco'=>$porcentajeTotal_empFco,
                 //'porcentajeTotal_empEmm'=>$porcentajeTotal_empEmm,
                 //'porcentajeTotal_empAdolf'=>$porcentajeTotal_empAdolf,
                 //'porcentajeTotal_trabFco'=>$porcentajeTotal_trabFco,
                 //'porcentajeTotal_trabEmm'=>$porcentajeTotal_trabEmm,
                 //'porcentajeTotal_trabAdolf'=>$porcentajeTotal_trabAdolf,
                  
                 //'total_empresas'=>$total_empresas,   
                 //'total_trabajadores'=>$total_trabajadores,
                 
                 'porcenAceptacionFco'=>$porcenAceptacionFco,
                 'porcenAceptacionEm'=>$porcenAceptacionEm,
                 'porcenAceptacionAd'=>$porcenAceptacionAd,
                     
                     //total general todo
                 'totalGeneralTodoSDA'=>$totalGeneralTodoSDA,
                 'totalGeneralTodoADH'=>$totalGeneralTodoADH,
                     
                 'totalGeneralTodoSDA'=>$totalGeneralTodoSDA,
                 'totalGeneralTodoADH'=>$totalGeneralTodoADH,
                 'EmpAcumulado'=>$EmpAcumulado,
                 'AdhAcumulado'=>$AdhAcumulado,  
                 'mes'=>$mes,
                 'totalGeneralTodoSDACom'=>$totalGeneralTodoSDACom,  
                 'totalGeneralTodoADHCom'=>$totalGeneralTodoADHCom,  
                     
                     
                ));
                
        }
        
        public function actionReporteSup($mes,$rut_sup){
            
             date_default_timezone_set('UTC');
                $year=date("Y");
            
                if($mes==="01"){$month="Enero";
            }elseif($mes==="02"){$month="Febrero";   
            }elseif($mes==="03"){$month="Marzo";   
            }elseif($mes==="04"){$month="Abril";   
            }elseif($mes==="05"){$month="Mayo";   
            }elseif($mes==="06"){$month="Junio";   
            }elseif($mes==="07"){$month="Julio";   
            }elseif($mes==="08"){$month="Agosto";   
            }elseif($mes==="09"){$month="Septiembre";   
            }elseif($mes==="10"){$month="Octubre";   
            }elseif($mes==="11"){$month="Noviembre";   
            }elseif($mes==="12"){$month="Diciembre";   
            }
                 
            //acumulados y general
            
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year' and (estado = 'Completa' or estado='Completa OPC')";
           
            (int)$totalGeneralTodoSDACom=Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$totalGeneralTodoADHCom=Yii::app()->db->createCommand($plsql2)->queryScalar();
  
            //Acululado
            
            $xx="SELECT COUNT( rut_empresa ) FROM solicitud_contrato";
            $yy="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato";
            
            (int)$EmpAcumulado=   Yii::app()->db->createCommand($xx)->queryScalar();
            (int)$AdhAcumulado=   Yii::app()->db->createCommand($yy)->queryScalar();
                
            
            $sql= "SELECT rut_ejecutivo FROM solicitud_contrato WHERE rut_sup = '$rut_sup' and MONTH(fecha_cambio_estado)= '$mes' and YEAR(fecha_cambio_estado)='$year' group by rut_ejecutivo";
           
                $rutEjecutivos = Yii::app()->db->createCommand($sql)->queryAll();
                $a=array();
                $tabla=array(); 
               
                foreach($rutEjecutivos as $data3){
                    $a[]=$data3['rut_ejecutivo'];
                }
                foreach($a as $rutAdo2){
       
                 $sql13="select nombre_ejecutivo from solicitud_contrato where rut_ejecutivo='$rutAdo2'";
                 $nombres_sup3=Yii::app()->db->createCommand($sql13)->queryScalar();
                 $sql23="select count(rut_empresa) from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                
                 (int) $cantidadIngresadas3 = Yii::app()->db->createCommand($sql23)->queryScalar();
                 $sql33="select count(rut_empresa) from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadCompletas3 = Yii::app()->db->createCommand($sql33)->queryScalar();
                 $sql43="select count(rut_empresa) from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadIncompletas3 = Yii::app()->db->createCommand($sql43)->queryScalar();
                 
                 $sql331="select count(rut_empresa) from solicitud_contrato where estado = 'Rechazada' and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadRechazada3 = Yii::app()->db->createCommand($sql331)->queryScalar();
                 $sql432="select count(rut_empresa) from solicitud_contrato where estado = 'Renuncia' and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadRenuncia3 = Yii::app()->db->createCommand($sql432)->queryScalar();
                 
                 
                 
                 
             $sql53="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC' or estado='Pendiente') and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadIngresadas3ADH = Yii::app()->db->createCommand($sql53)->queryScalar();
                 $sql63="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int) $cantidadCompletas3ADH = Yii::app()->db->createCommand($sql63)->queryScalar();
                 $sql73="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadIncompletas3ADH = Yii::app()->db->createCommand($sql73)->queryScalar();
                 
                 $sql633="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where estado = 'Rechazada' and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int) $cantidadRechazada3ADH = Yii::app()->db->createCommand($sql633)->queryScalar();
                 $sql733="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where estado = 'Renuncia' and rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadRenuncia3ADH = Yii::app()->db->createCommand($sql733)->queryScalar();
                 
                 
                 $sql83="select count(rut_empresa) from solicitud_contrato where rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadTotalEmpresas3 = Yii::app()->db->createCommand($sql83)->queryScalar();
                 $sql93="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_ejecutivo='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadTotalTrabajadores3 = Yii::app()->db->createCommand($sql93)->queryScalar();
                 
                 //comentarios del ejecutivo por si tiene devueltas
                 
                    $sql777=" SELECT rut_empresa, nombre_empresa,estado,fecha_cambio_estado, comentario FROM solicitud_contrato WHERE rut_ejecutivo = '$rutAdo2' AND MONTH( fecha_cambio_estado ) =$mes AND YEAR( fecha_cambio_estado ) = '$year'";
                    $tablaDetalle = Yii::app()->db->createCommand($sql777)->queryAll();
                 
                 $tabla[]="<tr>"
                         . "<td>$nombres_sup3</td>"
                         . "<td>$cantidadTotalEmpresas3</td>"
                         . "<td>$cantidadTotalTrabajadores3</td>"
                         . "<td>$cantidadIngresadas3</td>"
                         . "<td>$cantidadIngresadas3ADH</td>"
                         . "<td>$cantidadCompletas3</td>"
                         . "<td>$cantidadCompletas3ADH</td>"
                         . "<td>$cantidadIncompletas3</td>"
                         . "<td>$cantidadIncompletas3ADH</td>" 
                          . "<td>$cantidadRechazada3</td>"
                         . "<td>$cantidadRechazada3ADH</td>"
                         . "<td>$cantidadRenuncia3</td>"
                         . "<td>$cantidadRenuncia3ADH</td>"
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/detalleEjecutivos','mes'=>$mes, 'rut'=>$rutAdo2),array('class'=>'btn btn-xs btn-success'))."</td>"
                         . "</tr>";
                }
                $this->render('reporteSupervisores',array(
                       'tabla'=>$tabla,
                       'month'=>$month,
                       'mes'=>$mes,
                       'EmpAcumulado'=>$EmpAcumulado,
                       'AdhAcumulado'=>$AdhAcumulado, 
                       'totalGeneralTodoSDACom'=>$totalGeneralTodoSDACom,  
                       'totalGeneralTodoADHCom'=>$totalGeneralTodoADHCom,  
                    
                ));
                 
            }
            
        public function actionReporteSupPorFechas(){
            $vacios=false;
            if(!empty($_GET['RangoFechas']['fecha_inicio']) && !empty($_GET['RangoFechas']['fecha_fin'])){
              $tipo=1;
            }elseif(isset($_GET['fech1']) && isset($_GET['fech2'])){
             $tipo=2;   
            }else{
             $vacios=true;   
            }
            if($vacios==true){
                $this->render('error');
                        
            }else{
               if($tipo==2){   
                    
                $fech1=$_GET['fech1']." 00:00:00";
                $fech2=$_GET['fech2']." 23:59:59";
                $rut_sup=$_GET['rut'];
               }elseif($tipo==1){   
                $fech1=$_GET['RangoFechas']['fecha_inicio']." 00:00:00";
                $fech2=$_GET['RangoFechas']['fecha_fin']." 23:59:59";
                $rut_sup=Yii::app()->user->getState("rut"); 
               }
                date_default_timezone_set('UTC');
                $year=date("Y");
                 
            //acumulados y general
            
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year' and (estado = 'Completa' or estado='Completa OPC')";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year' and (estado = 'Completa' or estado='Completa OPC')";
           
            (int)$totalGeneralTodoSDACom=Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$totalGeneralTodoADHCom=Yii::app()->db->createCommand($plsql2)->queryScalar();
  
            //Acululado
            
            $xx="SELECT COUNT( rut_empresa ) FROM solicitud_contrato";
            $yy="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato";
            
            (int)$EmpAcumulado=   Yii::app()->db->createCommand($xx)->queryScalar();
            (int)$AdhAcumulado=   Yii::app()->db->createCommand($yy)->queryScalar();
                $sql= "SELECT rut_ejecutivo FROM solicitud_contrato WHERE rut_sup = '$rut_sup' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year' group by rut_ejecutivo";
           
                $rutEjecutivos = Yii::app()->db->createCommand($sql)->queryAll();
                $a=array();
                $tabla=array(); 
               
                foreach($rutEjecutivos as $data3){
                    $a[]=$data3['rut_ejecutivo'];
                }
                foreach($a as $rutAdo2){
       
                 $sql13="select nombre_ejecutivo from solicitud_contrato where rut_ejecutivo='$rutAdo2'";
                 $nombres_sup3=Yii::app()->db->createCommand($sql13)->queryScalar();
                 $sql23="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int) $cantidadIngresadas3 = Yii::app()->db->createCommand($sql23)->queryScalar();
                 $sql33="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadCompletas3 = Yii::app()->db->createCommand($sql33)->queryScalar();
                 $sql43="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadIncompletas3 = Yii::app()->db->createCommand($sql43)->queryScalar();
                 $sql53="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadIngresadas3ADH = Yii::app()->db->createCommand($sql53)->queryScalar();
                 $sql63="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC')  and rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int) $cantidadCompletas3ADH = Yii::app()->db->createCommand($sql63)->queryScalar();
                 $sql73="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC')  and rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadIncompletas3ADH = Yii::app()->db->createCommand($sql73)->queryScalar();
                 
                 
                 $sql83="select count(rut_empresa) from solicitud_contrato where rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadTotalEmpresas3 = Yii::app()->db->createCommand($sql83)->queryScalar();
                 $sql93="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_ejecutivo='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
                 (int)$cantidadTotalTrabajadores3 = Yii::app()->db->createCommand($sql93)->queryScalar();
                 
                 //comentarios del ejecutivo por si tiene devueltas
                 
                    $sql777=" SELECT rut_empresa, nombre_empresa,estado,fecha_cambio_estado, comentario FROM solicitud_contrato WHERE rut_ejecutivo =  '$rutAdo2' AND fecha_cambio_estado between '$fech1' and '$fech2' AND YEAR( fecha_cambio_estado ) =  '$year'";
                    $tablaDetalle = Yii::app()->db->createCommand($sql777)->queryAll();
                 
                 $tabla[]="<tr>"
                         . "<td>$nombres_sup3</td>"
                         . "<td>$cantidadTotalEmpresas3</td>"
                         . "<td>$cantidadTotalTrabajadores3</td>"
                         . "<td>$cantidadIngresadas3</td>"
                         . "<td>$cantidadIngresadas3ADH</td>"
                         . "<td>$cantidadCompletas3</td>"
                         . "<td>$cantidadCompletas3ADH</td>"
                         . "<td>$cantidadIncompletas3</td>"
                         . "<td>$cantidadIncompletas3ADH</td>" 
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/detalleEjecutivosPorFecha','fech1'=>$fech1,'fech2'=>$fech2, 'rut'=>$rutAdo2),array('class'=>'btn btn-xs btn-success'))."</td>"
                         . "</tr>";
                }
                $this->render('reporteSupervisores',array(
                       'tabla'=>$tabla,
                       'fech1'=>$fech1,
                       'fech2'=>$fech2,
                       'totalGeneralTodoSDACom'=>$totalGeneralTodoSDACom,
                       'totalGeneralTodoADHCom'=>$totalGeneralTodoADHCom,
                       'EmpAcumulado'=>$EmpAcumulado,
                       'AdhAcumulado'=>$AdhAcumulado,  
                    
                ));
                
                    
                }
            }
         public function reporteEje(){   
        }
        public function actionDetalleEjecutivos($mes,$rut){
            
              date_default_timezone_set('UTC');
                $year=date("Y");
                
                 if($mes==="01"){$month="Enero";
            }elseif($mes==="02"){$month="Febrero";   
            }elseif($mes==="03"){$month="Marzo";   
            }elseif($mes==="04"){$month="Abril";   
            }elseif($mes==="05"){$month="Mayo";   
            }elseif($mes==="06"){$month="Junio";   
            }elseif($mes==="07"){$month="Julio";   
            }elseif($mes==="08"){$month="Agosto";   
            }elseif($mes==="09"){$month="Septiembre";   
            }elseif($mes==="10"){$month="Octubre";   
            }elseif($mes==="11"){$month="Noviembre";   
            }elseif($mes==="12"){$month="Diciembre";   
            }
            
            $sql="select nombre_ejecutivo from solicitud_contrato where rut_ejecutivo='$rut'";
            $nombre=Yii::app()->db->createCommand($sql)->queryScalar();
            
             $sql2="SELECT nombre_ejecutivo,rut_ejecutivo,nombre_empresa,rut_empresa,cantidad_trabajadores,fecha_cambio_estado,vigencia,estado,comentario FROM solicitud_contrato WHERE rut_ejecutivo = '$rut' and MONTH(fecha_cambio_estado)= '$mes' and YEAR(fecha_cambio_estado)='$year'";
           
            $detalleEjecutivos=Yii::app()->db->createCommand($sql2)->queryAll();
            
            $this->render('reporteDetalleEjecutivos',array(
                       'detalleEjecutivos'=>$detalleEjecutivos,
                       'month'=>$month,  
                       'nombre'=>$nombre,
                ));
        }
        
        public function actionReportePorFechas()
	{
            if( Yii::app()->user->getState("tipo")==="administrador"){
                
                if(isset($_POST['Memo']['numero_memo'])){   
                   //REPORTE TOTAL DE SOLICITUDES            
                $memo=$_POST['Memo']['numero_memo'];
                
                $sql="select fecha_solicitud,rut_empresa,nombre_ejecutivo,vigencia from solicitud_contrato where nro_memo='$memo'";
                $datosMemo= Yii::app()->db->createCommand($sql)->queryAll();
                
                Yii::app()->request->sendFile('MEMO '.$memo.'.xls', 
                        $this->renderPartial('tablaMemo',array(
                            'memo'=>$memo,
                            'datosMemo'=>$datosMemo,
                        ),true));
               }else{
                //echo $_POST['numero_memo'];  
                echo $_POST['Memo']['numero_memo'];
               }
            }
        }
        
        public function actionDetalleEjecutivosPorFecha($fech1,$fech2,$rut){
            
            
            $fech11=$fech1." 00:00:00";
            $fech22=$fech2." 23:59:59";
            
              date_default_timezone_set('UTC');
                $year=date("Y");
            
            $sql="select nombre_ejecutivo from solicitud_contrato where rut_ejecutivo='$rut'";
            $nombre=Yii::app()->db->createCommand($sql)->queryScalar();
            
             $sql2="SELECT nombre_ejecutivo,rut_ejecutivo,nombre_empresa,rut_empresa,cantidad_trabajadores,fecha_cambio_estado,vigencia,estado,comentario FROM solicitud_contrato WHERE rut_ejecutivo = '$rut' and fecha_cambio_estado between '$fech11' and '$fech22' and YEAR(fecha_cambio_estado)='$year'";
           
            $detalleEjecutivos=Yii::app()->db->createCommand($sql2)->queryAll();
            
            $this->render('reporteDetalleEjecutivos',array(
                       'detalleEjecutivos'=>$detalleEjecutivos,
                       'nombre'=>$nombre,
                       'fech1'=>$fech1,
                       'fech2'=>$fech2,
                ));
        }
        
        protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionBuscar(){
            
            if(isset($_POST['Buscar']['rut'])){
                
                    $rutParse = str_replace('.', '', $_POST['Buscar']['rut']);   
                    $criterio=$rutParse;
                    
                    $sql="select * from solicitud_contrato where rut_empresa='$criterio'";
                    $consulta=Yii::app()->db->createCommand($sql)->queryAll();
                    if($consulta){
                    $this->render('resultBusqueda',array(
                            'consulta'=>$consulta,
                            'result'=>true
                        ));                
                    }else{
                        $this->render('resultBusqueda',array(
                            'consulta'=>$consulta,
                            'result'=>false,
                            'rut'=>$criterio
                        ));    
                    }
        
                 }
           }
          
        public function actionReporteGerenteGapPorFecha(){
            
             if(!empty($_GET['RangoFechas']['fecha_inicio']) && !empty($_GET['RangoFechas']['fecha_fin'])){
                $fech1=$_GET['RangoFechas']['fecha_inicio']." 00:00:00";
                $fech2=$_GET['RangoFechas']['fecha_fin']." 23:59:59";
            //PRIMERA TABLA REPORTE GENERAL DE SDA Y ADH
            date_default_timezone_set('UTC');
            $year=date("Y");
            
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year'";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE fecha_cambio_estado between '$fech1' and '$fech2' and YEAR(fecha_cambio_estado)='$year' and (estado = 'Completa' or estado='Completa OPC')";
           
            (int)$totalGeneralTodoSDACom=Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$totalGeneralTodoADHCom=Yii::app()->db->createCommand($plsql2)->queryScalar();
  
            //Acululado
            
            $xx="SELECT COUNT( rut_empresa ) FROM solicitud_contrato";
            $yy="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato";
            
            (int)$EmpAcumulado=   Yii::app()->db->createCommand($xx)->queryScalar();
            (int)$AdhAcumulado=   Yii::app()->db->createCommand($yy)->queryScalar();
            //META CONSTANTE
            (int)$metaSDA=8*48;
            (int)$metaADH=121*48;
            //PRIMERA TABLA REPORTE GENERAL DE SDA Y ADH
            
            //FRANCISCO
            $plsqlFco1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado = 'En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlFco2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlFco3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlFco4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlFco5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlFco6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            
            (int)$fcoTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlFco1)->queryScalar();
            (int)$fcoTotalSDACompletas=    Yii::app()->db->createCommand($plsqlFco2)->queryScalar();
            (int)$fcoTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlFco3)->queryScalar();
            (int)$fcoTotalADHRevision=  Yii::app()->db->createCommand($plsqlFco4)->queryScalar();
            (int)$fcoTotalADHCompletas=  Yii::app()->db->createCommand($plsqlFco5)->queryScalar();
            (int)$fcoTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlFco6)->queryScalar();
            
            //EMMANUEL
            
            $plsqlEm1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlEm2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlEm3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlEm4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlEm5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlEm6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            
            (int)$EmTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlEm1)->queryScalar();
            (int)$EmTotalSDACompletas=    Yii::app()->db->createCommand($plsqlEm2)->queryScalar();
            (int)$EmTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlEm3)->queryScalar();
            (int)$EmTotalADHRevision=  Yii::app()->db->createCommand($plsqlEm4)->queryScalar();
            (int)$EmTotalADHCompletas=  Yii::app()->db->createCommand($plsqlEm5)->queryScalar();
            (int)$EmTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlEm6)->queryScalar();
            
            //ADOLFO
            $plsqlAd1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlAd2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlAd3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlAd4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlAd5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Completa' or estado='Completa OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsqlAd6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
            
            (int)$AdTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlAd1)->queryScalar();
            (int)$AdTotalSDACompletas=    Yii::app()->db->createCommand($plsqlAd2)->queryScalar();
            (int)$AdTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlAd3)->queryScalar();
            (int)$AdTotalADHRevision=  Yii::app()->db->createCommand($plsqlAd4)->queryScalar();
            (int)$AdTotalADHCompletas=  Yii::app()->db->createCommand($plsqlAd5)->queryScalar();
            (int)$AdTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlAd6)->queryScalar();
            
            //RESULTADO FINAL PRIMERA TABLA 
            
            $totalGeneralSDARevision=$fcoTotalSDAEnRevision+$EmTotalSDAEnRevision+$AdTotalSDAEnRevision;
            $totalGeneralSDACompletas=$fcoTotalSDACompletas+$EmTotalSDACompletas+$AdTotalSDACompletas;
            $totalGeneralSDADevueltas=$fcoTotalSDADevueltas+$EmTotalSDADevueltas+$AdTotalSDADevueltas;
            $totalGeneralADHRevision=$fcoTotalADHRevision+$EmTotalADHRevision+$AdTotalADHRevision;
            $totalGeneralADHCompleta=$fcoTotalADHCompletas+$EmTotalADHCompletas+$AdTotalADHCompletas;
            $totalGeneralADHDevueltas=$fcoTotalADHDevueltas+$EmTotalADHDevueltas+$AdTotalADHDevueltas;
            
            $totalGeneralTodoSDA=$totalGeneralSDARevision+$totalGeneralSDACompletas+$totalGeneralSDADevueltas;
            $totalGeneralTodoADH=$totalGeneralADHRevision+$totalGeneralADHCompleta+$totalGeneralADHDevueltas;
            
            //-------------------FIN PRIMERA TABLA---------------------
            
            
            //SEGUNDA TABLA PORCENTAJE DE APORTE A LA GERENCIA
            
            //factor totales de división
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
            (int)$factorTotalSDA=   Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$factorTotalADH=   Yii::app()->db->createCommand($plsql2)->queryScalar();
            
            //francisco
            $plsql1fco="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and rut_jv='8820971-0'";
            $plsql2fco="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and rut_jv='8820971-0'";
            (int)$fcoCompletasSDA= Yii::app()->db->createCommand($plsql1fco)->queryScalar();
            (int)$fcoCompletasADH= Yii::app()->db->createCommand($plsql2fco)->queryScalar();
            
            //Emmanuel
             $plsql1Em="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and rut_jv='14198477-2'";
            $plsql2Em="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and rut_jv='14198477-2'";
            (int)$EmCompletasSDA= Yii::app()->db->createCommand($plsql1Em)->queryScalar();
            (int)$EmCompletasADH= Yii::app()->db->createCommand($plsql2Em)->queryScalar();
            
            //Adolfo
            $plsql1Ad="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and rut_jv='16666225-7'";
            $plsql2Ad="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2' and rut_jv='16666225-7'";
            (int)$AdCompletasSDA= Yii::app()->db->createCommand($plsql1Ad)->queryScalar();
            (int)$AdCompletasADH= Yii::app()->db->createCommand($plsql2Ad)->queryScalar();
            
            if($factorTotalSDA>0 && $factorTotalADH){
                
                $PorcentajeAporteSDAfco=round(($fcoCompletasSDA*100)/$factorTotalSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeAporteADHfco=round(($fcoCompletasADH*100)/$factorTotalADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeAporteSDAEm=round(($EmCompletasSDA*100)/$factorTotalSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeAporteADHEm=round(($EmCompletasADH*100)/$factorTotalADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeAporteSDAAd=round(($AdCompletasSDA*100)/$factorTotalSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeAporteADHAd=round(($AdCompletasADH*100)/$factorTotalADH, 0, PHP_ROUND_HALF_EVEN);
                
            }else{
               $PorcentajeAporteSDAfco=0;
                $PorcentajeAporteADHfco=0;
                
                $PorcentajeAporteSDAEm=0;
                $PorcentajeAporteADHEm=0;
                
                $PorcentajeAporteSDAAd=0;
                $PorcentajeAporteADHAd=0; 
            }
            
            
            //------------FIN SEGUNDA TABLA PORCENTAJES DE APORTE---------
            
            
            //TABLA PORCENTAJE DE CUMPPLIMIENTO
            
                $PorcentajeCumpliSDAfco= round(($fcoCompletasSDA*100)/$metaSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeCumpliADHfco= round(($fcoCompletasADH*100)/$metaADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeCumpliSDAEm=round(($EmCompletasSDA*100)/$metaSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeCumpliADHEm=round(($EmCompletasADH*100)/$metaADH, 0, PHP_ROUND_HALF_EVEN);
                
                $PorcentajeCumpliSDAAd=round(($AdCompletasSDA*100)/$metaSDA, 0, PHP_ROUND_HALF_EVEN);
                $PorcentajeCumpliADHAd=round(($AdCompletasADH*100)/$metaADH, 0, PHP_ROUND_HALF_EVEN);
     
            //-----------FIN TABLA PORCENTAJE DE CUMPPLIMIENTO---------------
            
            
              //Francisco 
          $sqlFcoSDA1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlFcoSDA2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Completa' or estado='Completa OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlFcoSDA3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlFcoADH1="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlFcoADH2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Completa' or estado='Completa OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlFcoADH3="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND (estado = 'Devuelta' or estado='Devuelta OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          
          $sqlFco4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlFco5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' and fecha_cambio_estado between '$fech1' and '$fech2'";
          
          (int)$fcoEnRevisionSDA=   Yii::app()->db->createCommand($sqlFcoSDA1)->queryScalar();
          (int)$fcoCompletasSDA=    Yii::app()->db->createCommand($sqlFcoSDA2)->queryScalar();
          (int)$fcoDevueltasSDA=  Yii::app()->db->createCommand($sqlFcoSDA3)->queryScalar();
          (int)$fcoEnRevisionADH=   Yii::app()->db->createCommand($sqlFcoADH1)->queryScalar();
          (int)$fcoCompletasADH=    Yii::app()->db->createCommand($sqlFcoADH2)->queryScalar();
          (int)$fcoDevueltasADH=  Yii::app()->db->createCommand($sqlFcoADH3)->queryScalar();
          
          
          (int)$fcoTotalEmpresas=  Yii::app()->db->createCommand($sqlFco4)->queryScalar();
          (int)$fcoTotalTrabajadores=  Yii::app()->db->createCommand($sqlFco5)->queryScalar();
                    if($fcoTotalEmpresas>0){
              
          (int)$porcenAceptacionFcoDiaz=($fcoCompletasSDA*100)/$fcoTotalEmpresas;
          
          $faltantesFcoSDA=$metaSDA-$fcoTotalEmpresas;
          $faltantesFcoADH=$metaADH-$fcoTotalTrabajadores;
          
          $porcenAceptacionFco= round($porcenAceptacionFcoDiaz, 0, PHP_ROUND_HALF_EVEN);
          }else{
              (int)$porcenAceptacionFco=0;
              (int)$faltantesFcoSDA=0;
              (int)$faltantesFcoADH=0;
          }
        //Emmanuel
          
          $sqlEm1SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlEm2SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlEm3SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlEm1ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlEm2ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Completa' or estado='Completa OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlEm3ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND (estado = 'Devuelta' or estado='Devuelta OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          
          
          
          $sqlEm4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' and fecha_cambio_estado between '$fech1' and '$fech2'"; 
          $sqlEm5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' and fecha_cambio_estado between '$fech1' and '$fech2'";
          (int)$EmEnRevisionSDA=   Yii::app()->db->createCommand($sqlEm1SDA)->queryScalar();
          (int)$EmCompletasSDA=    Yii::app()->db->createCommand($sqlEm2SDA)->queryScalar();
          (int)$EmDevueltasSDA=  Yii::app()->db->createCommand($sqlEm3SDA)->queryScalar();
          (int)$EmEnRevisionADH=   Yii::app()->db->createCommand($sqlEm1ADH)->queryScalar();
          (int)$EmCompletasADH=    Yii::app()->db->createCommand($sqlEm2ADH)->queryScalar();
          (int)$EmDevueltasADH=  Yii::app()->db->createCommand($sqlEm3ADH)->queryScalar();
          
          (int)$EmTotalEmpresas=  Yii::app()->db->createCommand($sqlEm4)->queryScalar();
          (int)$EmTotalTrabajadores=  Yii::app()->db->createCommand($sqlEm5)->queryScalar();
          
          $faltantesEmSDA=$metaSDA-$EmTotalEmpresas;
          $faltantesEmADH=$metaADH-$EmTotalTrabajadores;
          
          if($EmTotalEmpresas>0){
          (int)$porcenAceptacionEmSegura=($EmCompletasSDA*100)/$EmTotalEmpresas;
          (int)$porcenAceptacionEm= round($porcenAceptacionEmSegura, 0, PHP_ROUND_HALF_EVEN);
          }else{
              $porcenAceptacionEm=0;
              $porcenAceptacionEmSegura=0;
              $porcenAceptacionEm=0;
          }
          // Adolfo
          
          $sqlAd1SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlAd2SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Completa' or estado='Completa OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlAd3SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC')  and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlAd1ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'En revision' or estado='En revision OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlAd2ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Completa' or estado='Completa OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          $sqlAd3ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND (estado = 'Devuelta' or estado='Devuelta OPC') and fecha_cambio_estado between '$fech1' and '$fech2'";
          
          $sqlAd4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' and fecha_cambio_estado between '$fech1' and '$fech2'"; 
          $sqlAd5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' and fecha_cambio_estado between '$fech1' and '$fech2'";
          (int)$AdIngresadas=   Yii::app()->db->createCommand($sqlAd1SDA)->queryScalar();
          (int)$AdCompletas=    Yii::app()->db->createCommand($sqlAd2SDA)->queryScalar();
          (int)$AdIncompletas=  Yii::app()->db->createCommand($sqlAd3SDA)->queryScalar();
          (int)$AdIngresadasADH=   Yii::app()->db->createCommand($sqlAd1ADH)->queryScalar();
          (int)$AdCompletasADH=    Yii::app()->db->createCommand($sqlAd2ADH)->queryScalar();
          (int)$AdIncompletasADH=  Yii::app()->db->createCommand($sqlAd3ADH)->queryScalar();
          
          (int)$AdTotalEmpresas=  Yii::app()->db->createCommand($sqlAd4)->queryScalar();
          (int)$AdTotalTrabajadores=  Yii::app()->db->createCommand($sqlAd5)->queryScalar();
          
          $faltantesAdSDA=$metaSDA-$AdTotalEmpresas;
          $faltantesAdADH=$metaADH-$AdTotalTrabajadores;
         
          if($AdTotalEmpresas>0){
          (int)$porcenAceptacionAdGomez=($AdCompletas*100)/$AdTotalEmpresas;
           $porcenAceptacionAd= round($porcenAceptacionAdGomez, 0, PHP_ROUND_HALF_EVEN);
         }else{
            $porcenAceptacionAd=0;
            $porcenAceptacionAdGomez=0;
            $porcenAceptacionAd=0;
         }
            //SUPERVISORES
            
            $sql11="SELECT rut FROM usuario WHERE rut_padre = '8820971-0'";
            $nombres = Yii::app()->db->createCommand($sql11)->queryAll();
                foreach($nombres as $data){
                    $a[]=$data['rut'];
                }
                foreach($a as $rut){
                 $sql1="select nombre_sup from solicitud_contrato where rut_sup='$rut'";
                 $nombres_sup=Yii::app()->db->createCommand($sql1)->queryScalar();
                 $sql2="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIngresadas = Yii::app()->db->createCommand($sql2)->queryScalar();
                 $sql3="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC')  and rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                (int) $cantidadCompletas = Yii::app()->db->createCommand($sql3)->queryScalar();
                 $sql4="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC')  and rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                (int) $cantidadIncompletas = Yii::app()->db->createCommand($sql4)->queryScalar();
                 
                 $sql5="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIngresadasADH = Yii::app()->db->createCommand($sql5)->queryScalar();
                 $sql6="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadCompletasADH = Yii::app()->db->createCommand($sql6)->queryScalar();
                 $sql7="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIncompletasADH = Yii::app()->db->createCommand($sql7)->queryScalar();
               
                 
                 $sql8="select count(rut_empresa) from solicitud_contrato where rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadTotalEmpresas = Yii::app()->db->createCommand($sql8)->queryScalar();
                 $sql9="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rut' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadTotalTrabajadores = Yii::app()->db->createCommand($sql9)->queryScalar();
                 
                  $tableFco[]=
                         "<td>$nombres_sup</td>"
                         . "<td>$cantidadTotalEmpresas</td>"
                         . "<td>$cantidadTotalTrabajadores</td>"
                         . "<td>$cantidadIngresadas</td>"
                         . "<td>$cantidadIngresadasADH</td>"
                         . "<td>$cantidadCompletas</td>"
                         . "<td>$cantidadCompletasADH</td>"
                         . "<td>$cantidadIncompletas</td>"
                         . "<td>$cantidadIncompletasADH</td>" 
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/reporteSupPorFechas','fech1'=>$fech1,'fech2'=>$fech2, 'rut'=>$rut),array('class'=>'btn btn-xs btn-success'))."</td>";
                }
                 //tabla Emmanuel

                $sql111="SELECT rut FROM usuario WHERE rut_padre = '14198477-2'";
                $rutEm = Yii::app()->db->createCommand($sql111)->queryAll();
                $a2=array();
                $tableEmm=array();
                foreach($rutEm as $data2){
                    $a2[]=$data2['rut'];
                }
                foreach($a2 as $rutEm1){
                 $sql12="select nombre_sup from solicitud_contrato where rut_sup='$rutEm1'";
                 $nombres_sup2=Yii::app()->db->createCommand($sql12)->queryScalar();
                 
                 $sql22="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIngresadas2 = Yii::app()->db->createCommand($sql22)->queryScalar();
                 $sql32="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadCompletas2 = Yii::app()->db->createCommand($sql32)->queryScalar();
                 $sql42="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIncompletas2 = Yii::app()->db->createCommand($sql42)->queryScalar();
                 $sql52="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIngresadas2ADH = Yii::app()->db->createCommand($sql52)->queryScalar();
                 $sql62="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadCompletas2ADH = Yii::app()->db->createCommand($sql62)->queryScalar();
                 $sql72="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIncompletas2ADH = Yii::app()->db->createCommand($sql72)->queryScalar();
                 
                 $sql82="select count(rut_empresa) from solicitud_contrato where rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadTotalEmpresas2 = Yii::app()->db->createCommand($sql82)->queryScalar();
                 $sql92="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rutEm1' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadTotalTrabajadores2 = Yii::app()->db->createCommand($sql92)->queryScalar(); 
                  $tableEmm[]=
                         "<td>$nombres_sup2</td>"
                         . "<td>$cantidadTotalEmpresas2</td>"
                         . "<td>$cantidadTotalTrabajadores2</td>"
                         . "<td>$cantidadIngresadas2</td>"
                         . "<td>$cantidadIngresadas2ADH</td>"
                         . "<td>$cantidadCompletas2</td>"
                         . "<td>$cantidadCompletas2ADH</td>"
                         . "<td>$cantidadIncompletas2</td>"
                         . "<td>$cantidadIncompletas2ADH</td>" 
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/reporteSupPorFechas','fech1'=>$fech1,'fech2'=>$fech2, 'rut'=>$rutEm1),array('class'=>'btn btn-xs btn-success'))."</td>";
                }
          
                 //tabla Adolfo
                 
                $sql1Adol="SELECT rut FROM usuario WHERE rut_padre = '16666225-7'";
                $rutAdo1 = Yii::app()->db->createCommand($sql1Adol)->queryAll();
                $a3=array();
                $tableAdolfo=array();
                foreach($rutAdo1 as $data3){
                    $a3[]=$data3['rut'];
                }
                foreach($a3 as $rutAdo2){
                 $sql13="select nombre_sup from solicitud_contrato where rut_sup='$rutAdo2'";
                 $nombres_sup3=Yii::app()->db->createCommand($sql13)->queryScalar();
                 $sql23="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                (int) $cantidadIngresadas3 = Yii::app()->db->createCommand($sql23)->queryScalar();
                 $sql33="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadCompletas3 = Yii::app()->db->createCommand($sql33)->queryScalar();
                 $sql43="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIncompletas3 = Yii::app()->db->createCommand($sql43)->queryScalar();
                 $sql53="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'En revision' or estado='En revision OPC') and rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIngresadas3ADH = Yii::app()->db->createCommand($sql53)->queryScalar();
                 $sql63="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Completa' or estado='Completa OPC') and rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                (int) $cantidadCompletas3ADH = Yii::app()->db->createCommand($sql63)->queryScalar();
                 $sql73="select count(rut_empresa) as q_empresas from solicitud_contrato where (estado = 'Devuelta' or estado='Devuelta OPC') and rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadIncompletas3ADH = Yii::app()->db->createCommand($sql73)->queryScalar();
                 
                 
                 $sql83="select count(rut_empresa) from solicitud_contrato where rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadTotalEmpresas3 = Yii::app()->db->createCommand($sql83)->queryScalar();
                 $sql93="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rutAdo2' and fecha_cambio_estado between '$fech1' and '$fech2'";
                 (int)$cantidadTotalTrabajadores3 = Yii::app()->db->createCommand($sql93)->queryScalar();
                 
                   $tableAdolfo[]=
                         "<td>$nombres_sup3</td>"
                         . "<td>$cantidadTotalEmpresas3</td>"
                         . "<td>$cantidadTotalTrabajadores3</td>"
                         . "<td>$cantidadIngresadas3</td>"
                         . "<td>$cantidadIngresadas3ADH</td>"
                         . "<td>$cantidadCompletas3</td>"
                         . "<td>$cantidadCompletas3ADH</td>"
                         . "<td>$cantidadIncompletas3</td>"
                         . "<td>$cantidadIncompletas3ADH</td>" 
                         . "<td>".CHtml::link(CHtml::encode('Ver detalle'), array('/reporteBoss/reporteSupPorFechas','fech1'=>$fech1,'fech2'=>$fech2, 'rut'=>$rutAdo2),array('class'=>'btn btn-xs btn-success'))."</td>";
                
                 
                 
                 
                }  
          
                    
                $this->render('reporteGerenteGap',array(
                //PRIMERA TABLA FCO

                'metaADH'=>$metaADH, 
                'metaSDA'=>$metaSDA,  
                     
                'fcoTotalSDAEnRevision'=>$fcoTotalSDAEnRevision, 
                'fcoTotalSDACompletas'=>$fcoTotalSDACompletas,     
                'fcoTotalSDADevueltas'=>$fcoTotalSDADevueltas,
                'fcoTotalADHRevision'=>$fcoTotalADHRevision,
                'fcoTotalADHCompletas'=>$fcoTotalADHCompletas,
                'fcoTotalADHDevueltas'=>$fcoTotalADHDevueltas,
                     //EMMANUEL
                'EmTotalSDAEnRevision'=>$EmTotalSDAEnRevision, 
                'EmTotalSDACompletas'=>$EmTotalSDACompletas,     
                'EmTotalSDADevueltas'=>$EmTotalSDADevueltas,
                'EmTotalADHRevision'=>$EmTotalADHRevision,
                'EmTotalADHCompletas'=>$EmTotalADHCompletas,
                'EmTotalADHDevueltas'=>$EmTotalADHDevueltas,
                          //ADOLGO
                'AdTotalSDAEnRevision'=>$AdTotalSDAEnRevision, 
                'AdTotalSDACompletas'=>$AdTotalSDACompletas,     
                'AdTotalSDADevueltas'=>$AdTotalSDADevueltas,
                'AdTotalADHRevision'=>$AdTotalADHRevision,
                'AdTotalADHCompletas'=>$AdTotalADHCompletas,
                'AdTotalADHDevueltas'=>$AdTotalADHDevueltas,
                     //RESULTADOS
                'totalGeneralSDARevision'=>$totalGeneralSDARevision, 
                'totalGeneralSDACompletas'=>$totalGeneralSDACompletas,     
                'totalGeneralSDADevueltas'=>$totalGeneralSDADevueltas,
                'totalGeneralADHRevision'=>$totalGeneralADHRevision,
                'totalGeneralADHCompleta'=>$totalGeneralADHCompleta,
                'totalGeneralADHDevueltas'=>$totalGeneralADHDevueltas,
                     //SEGUNDA TABLA PORCENTAJE APORTE GERENCIA
                'factorTotalSDA'=>$factorTotalSDA, 
                'factorTotalADH'=>$factorTotalADH,     
                'fcoCompletasSDA'=>$fcoCompletasSDA,
                'fcoCompletasADH'=>$fcoCompletasADH,
                'EmCompletasSDA'=>$EmCompletasSDA,
                'EmCompletasADH'=>$EmCompletasADH, 
                     
                'AdCompletasSDA'=>$AdCompletasSDA,
                'AdCompletasADH'=>$AdCompletasADH,
                     //PORCENTAJES CUMPLIMIENTO
                'PorcentajeAporteSDAfco'=>$PorcentajeAporteSDAfco, 
                'PorcentajeAporteADHfco'=>$PorcentajeAporteADHfco,     
                'PorcentajeAporteSDAEm'=>$PorcentajeAporteSDAEm,
                'PorcentajeAporteADHEm'=>$PorcentajeAporteADHEm,
                'PorcentajeAporteSDAAd'=>$PorcentajeAporteSDAAd,
                'PorcentajeAporteADHAd'=>$PorcentajeAporteADHAd,
                     
                     //porcentajes 
                'PorcentajeCumpliSDAfco'=>$PorcentajeCumpliSDAfco, 
                'PorcentajeCumpliADHfco'=>$PorcentajeCumpliADHfco,     
                'PorcentajeCumpliSDAEm'=>$PorcentajeCumpliSDAEm,
                'PorcentajeCumpliADHEm'=>$PorcentajeCumpliADHEm,
                'PorcentajeCumpliSDAAd'=>$PorcentajeCumpliSDAAd,
                'PorcentajeCumpliADHAd'=>$PorcentajeCumpliADHAd,
                     
                 //SUPERVISORES
                 'tableFco'=>$tableFco,
                 'tableEmm'=>$tableEmm,
                 'tableAdolfo'=>$tableAdolfo,
                 //Francisco
                 'fcoEnRevisionSDA'=>$fcoEnRevisionSDA,
                 'fcoCompletasSDA'=>$fcoCompletasSDA,
                 'fcoDevueltasSDA'=>$fcoDevueltasSDA,
                 'fcoEnRevisionADH'=>$fcoEnRevisionADH,
                 'fcoCompletasADH'=>$fcoCompletasADH,
                 'fcoDevueltasADH'=>$fcoDevueltasADH,
                     
                 'fcoTotalEmpresas'=>$fcoTotalEmpresas,
                 'fcoTotalTrabajadores'=>$fcoTotalTrabajadores,
                 'faltantesFcoSDA'=>$faltantesFcoSDA,
                 'faltantesFcoADH'=>$faltantesFcoADH,
                 //emmanuel
                 'EmEnRevisionSDA'=>$EmEnRevisionSDA,
                 'EmCompletasSDA'=>$EmCompletasSDA,
                 'EmDevueltasSDA'=>$EmDevueltasSDA,
                 'EmEnRevisionADH'=>$EmEnRevisionADH,
                 'EmCompletasADH'=>$EmCompletasADH,
                 'EmDevueltasADH'=>$EmDevueltasADH,
                     
                 'EmTotalEmpresas'=>$EmTotalEmpresas,
                 'EmTotalTrabajadores'=>$EmTotalTrabajadores,
                 'faltantesEmSDA'=>$faltantesFcoSDA,
                 'faltantesEmADH'=>$faltantesFcoADH,
                 //Adolfo        
                 'AdIngresadas'=>$AdIngresadas,
                 'AdCompletas'=>$AdCompletas,
                 'AdIncompletas'=>$AdIncompletas,
                 'AdIngresadasADH'=>$AdIngresadasADH,
                 'AdCompletasADH'=>$AdCompletasADH,
                 
                 'AdIncompletasADH'=>$AdIncompletasADH,
                 'AdTotalEmpresas'=>$AdTotalEmpresas,
                 'AdTotalTrabajadores'=>$AdTotalTrabajadores,
                 'faltantesAdSDA'=>$faltantesAdSDA,
                 'faltantesAdADH'=>$faltantesAdADH, 
                 //TOTALES
                 //'porcentajeTotal_empFco'=>$porcentajeTotal_empFco,
                 //'porcentajeTotal_empEmm'=>$porcentajeTotal_empEmm,
                 //'porcentajeTotal_empAdolf'=>$porcentajeTotal_empAdolf,
                 //'porcentajeTotal_trabFco'=>$porcentajeTotal_trabFco,
                 //'porcentajeTotal_trabEmm'=>$porcentajeTotal_trabEmm,
                 //'porcentajeTotal_trabAdolf'=>$porcentajeTotal_trabAdolf,
                  
                 //'total_empresas'=>$total_empresas,   
                 //'total_trabajadores'=>$total_trabajadores,
                 
                 'porcenAceptacionFco'=>$porcenAceptacionFco,
                 'porcenAceptacionEm'=>$porcenAceptacionEm,
                 'porcenAceptacionAd'=>$porcenAceptacionAd,
                     
                     //total general todo
                 'totalGeneralTodoSDA'=>$totalGeneralTodoSDA,
                 'totalGeneralTodoADH'=>$totalGeneralTodoADH,
                     
                 'totalGeneralTodoSDA'=>$totalGeneralTodoSDA,
                 'totalGeneralTodoADH'=>$totalGeneralTodoADH,
                 'EmpAcumulado'=>$EmpAcumulado,
                 'AdhAcumulado'=>$AdhAcumulado,
                 'totalGeneralTodoSDACom'=>$totalGeneralTodoSDACom,  
                 'totalGeneralTodoADHCom'=>$totalGeneralTodoADHCom,
                    'fech1'=>$fech1,
                    'fech2'=>$fech2,  
                     
                ));
             }else{
              $this->render('error');
             }
        }
        
        public function actionVerAccesos($tipo){
            
            if($tipo=="gerente"){
                $a=array();
                $tabla=array();
                //solo Jefes de venta
                $jv="select rut from usuario where tipo='jefe de venta' and estado='Activo'";
                $RutJv=Yii::app()->db->createCommand($jv)->queryAll();
                
                 foreach($RutJv as $data){
                    $rut=$data['rut'];
                    $sql1="SELECT nombre_usuario FROM registro_reportes WHERE rut_usuario = '$rut'";
                    $sql2="SELECT rut_usuario FROM registro_reportes WHERE rut_usuario = '$rut'";
                    $sql3="SELECT fecha_conexion FROM registro_reportes WHERE rut_usuario = '$rut' order by fecha_conexion desc limit 1";
                    $sql4="SELECT count(rut_usuario)as cantidad FROM registro_reportes WHERE rut_usuario = '$rut'";
                    
                    $jefesV1=Yii::app()->db->createCommand($sql1)->queryScalar();
                    $jefesV2=Yii::app()->db->createCommand($sql2)->queryScalar();
                    $jefesV3=Yii::app()->db->createCommand($sql3)->queryScalar();
                    $jefesV4=Yii::app()->db->createCommand($sql4)->queryScalar();
                    if($jefesV1!=false||$jefesV2!=false||$jefesV3!=false||$jefesV4!=false){
                           $tabla[]="<tr>"
                         . "<td>$jefesV1</td>"
                         . "<td>$jefesV2</td>"
                         . "<td>$jefesV3</td>"
                         . "<td>$jefesV4</td>"
                         . "</tr>";
                    }else{
                    }
                 }
                 
                 //solo supervisores
                $jv="select rut from usuario where tipo='supervisor' and estado='Activo'";
                $RutSup=Yii::app()->db->createCommand($jv)->queryAll();
                
                 foreach($RutSup as $data){
                    $rut=$data['rut'];
                    $sql11="SELECT nombre_sup FROM solicitud_contrato WHERE rut_sup = '$rut'";
                    $sql22="SELECT rut_sup FROM solicitud_contrato WHERE rut_sup = '$rut'";
                    $sql33="SELECT fecha_conexion FROM registro_reportes WHERE rut_usuario = '$rut' order by fecha_conexion desc limit 1";
                    $sql44="SELECT count(rut_usuario)as cantidad FROM registro_reportes WHERE rut_usuario = '$rut'";
                    
                    $SupV1=Yii::app()->db->createCommand($sql11)->queryScalar();
                    $SupV2=Yii::app()->db->createCommand($sql22)->queryScalar();
                    
                    $SupV3=Yii::app()->db->createCommand($sql33)->queryScalar();
                    if($SupV3==false){
                        $SupV3="<p style='color:red;'>Nunca<p>";
                    }
                    $SupV4=Yii::app()->db->createCommand($sql44)->queryScalar();
                    if($SupV1!=false||$SupV2!=false||$SupV4!=false){
                           $tablaSup[]="<tr>"
                         . "<td>$SupV1</td>"
                         . "<td>$SupV2</td>"
                         . "<td>$SupV3</td>"
                         . "<td>$SupV4</td>"
                         . "</tr>";
                    }else{
                        
                     
                        
                    }
                 }
                $this->render('detalleConexiones',array(
                        'tabla'=>$tabla,
                        'tablaSup'=>$tablaSup,
                ));
            }elseif($tipo=="jefe de venta"){
                
                 //solo supervisores
                $jv="select rut from usuario where tipo='supervisor' and estado='Activo'";
                $RutSup=Yii::app()->db->createCommand($jv)->queryAll();
                
                 foreach($RutSup as $data){
                    $rut=$data['rut'];
                    $sql11="SELECT nombre_sup FROM solicitud_contrato WHERE rut_sup = '$rut'";
                    $sql22="SELECT rut_sup FROM solicitud_contrato WHERE rut_sup = '$rut'";
                    $sql33="SELECT fecha_conexion FROM registro_reportes WHERE rut_usuario = '$rut' order by fecha_conexion desc limit 1";
                    $sql44="SELECT count(rut_usuario)as cantidad FROM registro_reportes WHERE rut_usuario = '$rut'";
                    
                    $SupV1=Yii::app()->db->createCommand($sql11)->queryScalar();
                    $SupV2=Yii::app()->db->createCommand($sql22)->queryScalar();
                    $SupV3=Yii::app()->db->createCommand($sql33)->queryScalar();
                      if($SupV3==false){
                        $SupV3="<p style='color:red;'>Nunca<p>";
                    }
                    $SupV4=Yii::app()->db->createCommand($sql44)->queryScalar();
                    
                     if($SupV1!=false||$SupV2!=false||$SupV4!=false){
                    
                           $tablaSup[]="<tr>"
                         . "<td>$SupV1</td>"
                         . "<td>$SupV2</td>"
                         . "<td>$SupV3</td>"
                         . "<td>$SupV4</td>"
                         . "</tr>";
                     }else{
                         
                     }
                 }
                $this->render('detalleConexiones',array(
                        
                        'tablaSup'=>$tablaSup,
                ));
                
            }
            
            
        }
        
        public function ActionDescargaExcel($op,$fecha1=null,$fecha2=null,$mesi=null){
            
            if(Yii::app()->user->getState("tipo")==="supervisor"){
            
            $rut_supervisor=Yii::app()->user->getState("rut");
            
            if($op==="rango"){
                $sql="SELECT * FROM solicitud_contrato WHERE rut_sup = '$rut_supervisor' and fecha_cambio_estado between '$fecha1' and '$fecha2'";
                $result=Yii::app()->db->createCommand($sql)->queryAll();
                 Yii::app()->request->sendFile('Datos empresas '.$fecha1.' al '.$fecha2.'.xls', $this->renderPartial('excel',array(
                 'result'=>$result,
             ),true));
            }elseif($op==="mes"){
             if($mesi==="Enero"){$month="01";}elseif($mesi==="Febrero"){$month="02";   
            }elseif($mesi==="Marzo"){$month="03";}elseif($mesi==="Abril"){$month="04";   
            }elseif($mesi==="Mayo"){$month="05";}elseif($mesi==="Junio"){$month="06";   
            }elseif($mesi==="Julio"){$month="07";}elseif($mesi==="Agosto"){$month="08";   
            }elseif($mesi==="Septiembre"){$month="09";}elseif($mesi==="Octubre"){$month="10";
            }elseif($mesi==="Noviembre"){$month="11";}elseif($mesi==="Diciembre"){$month="12";   
            }
                
                $sql="SELECT * FROM solicitud_contrato WHERE rut_sup = '$rut_supervisor' and MONTH(fecha_cambio_estado)= $month";
                $result=Yii::app()->db->createCommand($sql)->queryAll();
                  Yii::app()->request->sendFile('Datos empresas '.'mes de '.$mesi.'.xls', $this->renderPartial('excel',array(
                 'result'=>$result,
             ),true));
                
                
                
            }
        }elseif(Yii::app()->user->getState("tipo")==="jefe de venta"||Yii::app()->user->getState("tipo")==="gerente"
                || Yii::app()->user->getState("tipo")==="administrador"){
            
            if($op==="rango"){
                $sql="SELECT * FROM solicitud_contrato WHERE fecha_cambio_estado between '$fecha1' and '$fecha2'";
                $result=Yii::app()->db->createCommand($sql)->queryAll();
                 Yii::app()->request->sendFile('Datos empresas '.$fecha1.' al '.$fecha2.'.xls', $this->renderPartial('excel',array(
                 'result'=>$result,
             ),true));
            }elseif($op==="mes"){
             if($mesi==="Enero"){$month="01";}elseif($mesi==="Febrero"){$month="02";   
            }elseif($mesi==="Marzo"){$month="03";}elseif($mesi==="Abril"){$month="04";   
            }elseif($mesi==="Mayo"){$month="05";}elseif($mesi==="Junio"){$month="06";   
            }elseif($mesi==="Julio"){$month="07";}elseif($mesi==="Agosto"){$month="08";   
            }elseif($mesi==="Septiembre"){$month="09";}elseif($mesi==="Octubre"){$month="10";
            }elseif($mesi==="Noviembre"){$month="11";}elseif($mesi==="Diciembre"){$month="12";   
            }
                
                $sql="SELECT * FROM solicitud_contrato WHERE MONTH(fecha_cambio_estado)= $month";
                $result=Yii::app()->db->createCommand($sql)->queryAll();
                  Yii::app()->request->sendFile('Datos empresas '.'mes de '.$mesi.'.xls', $this->renderPartial('excel',array(
                 'result'=>$result,
             ),true));
                
                
                
            }     
        }
        
        
        }
        public function cantidadDependientes($rutJV){
                
                     $tabla="";
                     $sumaEje=0;
                     
                     $sql11="SELECT rut FROM usuario where tipo='supervisor' and estado='Activo' and rut_padre='$rutJV'";
                     $sup=Yii::app()->db->createCommand($sql11)->queryAll();
                     foreach($sup as $data){
                     $a[]=$data['rut'];   
                      }
                     foreach($a as $rut2){
                         
                     $sql22="SELECT concat(nombre,' ',apellido) FROM usuario where rut='$rutJV' and estado='Activo'";
                     $nombreJv=Yii::app()->db->createCommand($sql22)->queryScalar();    
                         
                     $sql33="SELECT count(rut) FROM usuario where rut_padre='$rutJV' and estado='Activo'";
                     $cantidadSup=Yii::app()->db->createCommand($sql33)->queryScalar();    
                         
                     $sql333="SELECT count(rut) FROM usuario where rut_padre='$rut2' and estado='Activo'";
                     $cantidadEje=Yii::app()->db->createCommand($sql333)->queryScalar();
                     $sumaEje=$sumaEje+$cantidadEje;
                     
                     $tabla="$nombreJv"."-"."$cantidadSup"."-"."$sumaEje";
                     }
                     return $tabla;
        }
        
        
        public function actionVerDotacion(){
            
            $tabla=array();
            if(Yii::app()->user->getState('tipo')=='gerente'){
                $rutFco="8820971-0";
                $rutEmm="14198477-2";
                $rutAdol="16666225-7";
                
                $a=array();
                
                $cantFco=$this->cantidadDependientes($rutFco);
                $numFco = explode("-", $cantFco);
                   $numFco[0]; // nombre
                   $numFco[1]; // cantidad sup
                   $numFco[2]; // cantidad eje
       

                $cantEmm=$this->cantidadDependientes($rutEmm);
                $numEmm = explode("-", $cantEmm);
                   $numEmm[0];$numEmm[1];$numEmm[2];
                   
                $cantAdol=$this->cantidadDependientes($rutAdol);
                  $numAdol= explode("-", $cantAdol);
                   $numAdol[0];$numAdol[1];$numAdol[2];
                   
                   $sumatotalSup=$numFco[1]+$numEmm[1]+$numAdol[1];
                   $sumatotalEje=$numFco[2]+$numEmm[2]+$numAdol[2];
                
                $tabla[]="<tr><td>$numFco[0]</td><td>$numFco[1]</td><td>$numFco[2]</td></tr>".
                         "<tr><td>$numEmm[0]</td><td>$numEmm[1]</td><td>$numEmm[2]</td></tr>".
                         "<tr><td>$numAdol[0]</td><td>$numAdol[1]</td><td>$numAdol[2]</td></tr>".
                         "<tr><td><b>Total</b></td><td><b>$sumatotalSup</b></td><td><b>$sumatotalEje</b></td></tr>";
                    
            }
            
            
            $sql="SELECT rut,nombre,apellido,telefono,email,direccion,fecha_ingreso,fecha_salida,estado,tipo,rut_padre FROM usuario";
            $dotacion=Yii::app()->db->createCommand($sql)->queryAll();
                $this->render('dotacion',array(
                'dotacion'=>$dotacion,
                'tabla'=>$tabla    
             ));  
            
        }
        
        public function actionReporteNumerosEjecutivos(){
            $op=$_POST['Buscar']['op'];
            
             $sql11="SELECT rut FROM usuario WHERE tipo = 'ejecutivo'";
            $nombres = Yii::app()->db->createCommand($sql11)->queryAll();
            $name=new SolicitudContrato();
                foreach($nombres as $data){
                    $a[]=$data['rut'];
                }
                foreach($a as $rut){
                   
                 $nombres_jv=$name->getNombreJefVenta($rut);
               
                 $nombres_sup=$name->getNombreSup($rut);
               
                 $sql169="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut'";
                 $nombres_eje=Yii::app()->db->createCommand($sql169)->queryScalar();
                 
                 $sql4="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and (MONTH(fecha_cambio_estado)= 1 or MONTH(fecha_cambio_estado)= 12)";
                (int) $cantidadEnero = Yii::app()->db->createCommand($sql4)->queryScalar();
                $sql5="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 2";
                (int) $cantidadFeb = Yii::app()->db->createCommand($sql5)->queryScalar();
                $sql6="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 3";
                (int) $cantidadMarzo = Yii::app()->db->createCommand($sql6)->queryScalar();
                $sql7="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 4";
                (int) $cantidadAbril = Yii::app()->db->createCommand($sql7)->queryScalar();
                $sql8="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 5";
                (int) $cantidadMayo = Yii::app()->db->createCommand($sql8)->queryScalar();
                $sql9="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 6";
                (int) $cantidadJunio = Yii::app()->db->createCommand($sql9)->queryScalar();
                $sql10="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 7";
                (int) $cantidadJul = Yii::app()->db->createCommand($sql10)->queryScalar();
                $sql11="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 8";
                (int) $cantidadAgo = Yii::app()->db->createCommand($sql11)->queryScalar();
                $sql12="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 9";
                (int) $cantidadSep = Yii::app()->db->createCommand($sql12)->queryScalar();
                $sql13="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 10";
                (int) $cantidadOct = Yii::app()->db->createCommand($sql13)->queryScalar();
                $sql14="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 11";
                (int) $cantidadNov = Yii::app()->db->createCommand($sql14)->queryScalar();
                $sql15="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 12 and YEAR(fecha_cambio_estado)='2014'";
                (int) $cantidadDic = Yii::app()->db->createCommand($sql15)->queryScalar();
                $sql11212="select estado from usuario where rut='$rut'";
                (int) $estado = Yii::app()->db->createCommand($sql11212)->queryScalar();
                
                // empresas mayores a 10
                $sql411="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and (MONTH(fecha_cambio_estado)= 1 or MONTH(fecha_cambio_estado)= 12) and cantidad_trabajadores>=$op";
                (int) $cantidadEnero10 = Yii::app()->db->createCommand($sql411)->queryScalar();
                $sql51="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 2 and cantidad_trabajadores>=$op";
                (int) $cantidadFeb10 = Yii::app()->db->createCommand($sql51)->queryScalar();
                $sql61="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 3 and cantidad_trabajadores>=$op";
                (int) $cantidadMarzo10 = Yii::app()->db->createCommand($sql61)->queryScalar();
                $sql71="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 4 and cantidad_trabajadores>=$op";
                (int) $cantidadAbril10 = Yii::app()->db->createCommand($sql71)->queryScalar();
                $sql81="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 5 and cantidad_trabajadores>=$op";
                (int) $cantidadMayo10 = Yii::app()->db->createCommand($sql81)->queryScalar();
                $sql91="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 6 and cantidad_trabajadores>=$op";
                (int) $cantidadJunio10 = Yii::app()->db->createCommand($sql91)->queryScalar();
                $sql101="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 7 and cantidad_trabajadores>=$op";
                (int) $cantidadJul10 = Yii::app()->db->createCommand($sql101)->queryScalar();
                $sql111="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 8 and cantidad_trabajadores>=$op";
                (int) $cantidadAgo10 = Yii::app()->db->createCommand($sql111)->queryScalar();
                $sql121="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 9 and cantidad_trabajadores>=$op";
                (int) $cantidadSep10 = Yii::app()->db->createCommand($sql121)->queryScalar();
                $sql131="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 10 and cantidad_trabajadores>=$op";
                (int) $cantidadOct10 = Yii::app()->db->createCommand($sql131)->queryScalar();
                $sql141="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 11 and cantidad_trabajadores>=$op";
                (int) $cantidadNov10 = Yii::app()->db->createCommand($sql141)->queryScalar();
                $sql151="select count(rut_empresa) as cantEmpresas from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 12 and cantidad_trabajadores>=$op and YEAR(fecha_cambio_estado)='2014'";
                (int) $cantidadDic10 = Yii::app()->db->createCommand($sql151)->queryScalar();
                
                //cantidad de trabajadores
                
                $sql422="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and (MONTH(fecha_cambio_estado)= 1 or MONTH(fecha_cambio_estado)= 12)";
                (int) $cantidadEneroT = Yii::app()->db->createCommand($sql422)->queryScalar();
                $sql522="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 2";
                (int) $cantidadFebT = Yii::app()->db->createCommand($sql522)->queryScalar();
                $sql622="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 3";
                (int) $cantidadMarzoT = Yii::app()->db->createCommand($sql622)->queryScalar();
                $sql722="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 4";
                (int) $cantidadAbrilT = Yii::app()->db->createCommand($sql722)->queryScalar();
                $sql8="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 5";
                (int) $cantidadMayoT = Yii::app()->db->createCommand($sql8)->queryScalar();
                $sql922="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 6";
                (int) $cantidadJunioT = Yii::app()->db->createCommand($sql922)->queryScalar();
                $sql1022="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 7";
                (int) $cantidadJulT = Yii::app()->db->createCommand($sql1022)->queryScalar();
                $sql1122="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 8";
                (int) $cantidadAgoT = Yii::app()->db->createCommand($sql1122)->queryScalar();
                $sql1222="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 9";
                (int) $cantidadSepT = Yii::app()->db->createCommand($sql1222)->queryScalar();
                $sql1322="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 10";
                (int) $cantidadOctT = Yii::app()->db->createCommand($sql1322)->queryScalar();
                $sql1422="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 11";
                (int) $cantidadNovT = Yii::app()->db->createCommand($sql1422)->queryScalar();
                $sql1522="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Completa' or estado='Completa OPC') and rut_ejecutivo='$rut' and MONTH(fecha_cambio_estado)= 12 and YEAR(fecha_cambio_estado)='2014'";
                (int) $cantidadDicT = Yii::app()->db->createCommand($sql1522)->queryScalar();
                
   
                
                
                $tabla[]="<td>$nombres_jv</td><td>$nombres_sup</td><td>$nombres_eje</td><td>$estado</td>"
                   . "<td>$cantidadEnero</td><td>$cantidadEneroT</td><td>$cantidadEnero10</td>"
                   . "<td>$cantidadFeb</td><td>$cantidadFebT</td><td>$cantidadFeb10</td>"    
                   . "<td>$cantidadMarzo</td><td>$cantidadMarzoT</td><td>$cantidadMarzo10</td>"
                   . "<td>$cantidadAbril</td><td>$cantidadAbrilT</td><td>$cantidadAbril10</td>"
                   . "<td>$cantidadMayo</td><td>$cantidadMayoT</td><td>$cantidadMayo10</td>"    
                   . "<td>$cantidadJunio</td><td>$cantidadJunioT</td><td>$cantidadJunio10</td>"    
                   . "<td>$cantidadJul</td><td>$cantidadJulT</td><td>$cantidadJul10</td>"
                   . "<td>$cantidadAgo</td><td>$cantidadAgoT</td><td>$cantidadAgo10</td>"    
                   . "<td>$cantidadSep</td><td>$cantidadSepT</td><td>$cantidadSep10</td>"     
                   . "<td>$cantidadOct</td><td>$cantidadOctT</td><td>$cantidadOct10</td>"
                   . "<td>$cantidadNov</td><td>$cantidadNovT</td><td>$cantidadNov10</td>"     
                   . "<td>$cantidadDic</td><td>$cantidadDicT</td><td>$cantidadDic10</td>";
                
                }
             Yii::app()->request->sendFile('Cantidad_de_empresas.xls', $this->renderPartial('excel_cantidad',array(
                'tabla'=>$tabla,
                'op'=>$op,
            ),true));  
        
        
        }
        public function actionRanking(){
                
                date_default_timezone_set('UTC');
                $mes=date("m"); 
                $sql11="SELECT rut FROM usuario WHERE tipo = 'ejecutivo' and estado='Activo'";
                $nombres = Yii::app()->db->createCommand($sql11)->queryAll();
                $name=new SolicitudContrato();
                foreach($nombres as $data){
                    $a[]=$data['rut'];
                }
                foreach($a as $rut){
                 $nombres_jv=$name->getNombreJefVenta($rut);
                 $nombres_sup=$name->getNombreSup($rut);
                 $sql1="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut'";
                 $nombre_eje=Yii::app()->db->createCommand($sql1)->queryScalar();
                 $sql2="select count(rut_empresa) from solicitud_contrato where rut_ejecutivo='$rut' and (estado='Completa' or estado='Completa OPC')";
                 (int)$contratos=Yii::app()->db->createCommand($sql2)->queryScalar();
                 $sql3="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_ejecutivo='$rut' and (estado='Completa' or estado='Completa OPC')";
                 (int)$trabajadores=Yii::app()->db->createCommand($sql3)->queryScalar();
                 
                  $sql244="select MONTH(fecha_ingreso) from usuario where rut='$rut'";
                 $mesIngreso=Yii::app()->db->createCommand($sql244)->queryScalar();
                
                 
                 (int)$mesesTrab=($mes-$mesIngreso)+1;
                 (int)$promedio=$trabajadores/$mesesTrab;
                 
                 $tabla[]="<td></td><td>$nombres_jv</td><td>$nombres_sup</td><td>$nombre_eje</td><td>$rut</td><td>$contratos</td><td>$trabajadores</td><td>$mesesTrab</td><td>".round($promedio, 1)."</td>";
                
                }
                if(isset($_GET['excel'])=='1'){
                    Yii::app()->request->sendFile('Ranking_ejecutivos.xls', $this->renderPartial('excel_ranking',array(
                    'tabla'=>$tabla,
                    ),true));  
                }
            $this->render('ranking',array(
                'tabla'=>$tabla,
            ));
        }
        
        public function convertirMes($mes){
            if($mes==="01"){$month="Enero";
            }elseif($mes==="02"){return $month="Febrero";   
            }elseif($mes==="03"){return $month="Marzo";   
            }elseif($mes==="04"){return $month="Abril";   
            }elseif($mes==="05"){return $month="Mayo";   
            }elseif($mes==="06"){return $month="Junio";   
            }elseif($mes==="07"){return $month="Julio";   
            }elseif($mes==="08"){return $month="Agosto";   
            }elseif($mes==="09"){return $month="Septiembre";   
            }elseif($mes==="10"){return $month="Octubre";   
            }elseif($mes==="11"){return $month="Noviembre";   
            }elseif($mes==="12"){return $month="Diciembre";   
            }
        }
        
        public function actionRankingMensual(){
            
            if(isset($_GET['mes'])){
                $mes=$_GET['mes'];
                date_default_timezone_set('UTC');
                $year=date("Y");
                
                $fech="$year-$mes-01";
              
                
                $sql11="SELECT rut FROM usuario WHERE tipo = 'ejecutivo' and estado='Activo' and month(fecha_ingreso) <= '$mes'";
                $nombres = Yii::app()->db->createCommand($sql11)->queryAll();
                $name=new SolicitudContrato();
                foreach($nombres as $data){
                    $a[]=$data['rut'];
                }
                foreach($a as $rut){
                    
                 $nombres_jv2 = "select dependencia_jv from historial_dependencias where rut='$rut' and fech_inicio_depen >= '$fech' and fech_termino_depen <= LAST_DAy('$fech')";
                 $nombres_jv=Yii::app()->db->createCommand($nombres_jv2)->queryScalar();  
               
                 $nombres_sup2 = "select dependencia_sup from historial_dependencias where rut='$rut' and fech_inicio_depen >= '$fech' and fech_termino_depen <= LAST_DAy('$fech')";
                 $nombres_sup=Yii::app()->db->createCommand($nombres_sup2)->queryScalar();
              
                 
                 $sql1="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rut'";
                 $nombre_eje=Yii::app()->db->createCommand($sql1)->queryScalar();
                 $sql2="select count(rut_empresa) from solicitud_contrato where rut_ejecutivo='$rut' and (estado='Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$contratos=Yii::app()->db->createCommand($sql2)->queryScalar();
                 $sql3="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_ejecutivo='$rut' and (estado='Completa' or estado='Completa OPC') and MONTH(fecha_cambio_estado)= $mes and YEAR(fecha_cambio_estado)='$year'";
                 (int)$trabajadores=Yii::app()->db->createCommand($sql3)->queryScalar();
              
                 
                 $tabla[]="<td></td><td>$nombres_jv</td><td>$nombres_sup</td><td>$nombre_eje</td><td>$contratos</td><td>$trabajadores</td>";
                 //arsort($tabla);
                }
                  if(isset($_GET['excel'])=='1'){
                    Yii::app()->request->sendFile('Ranking_Mensual_ejecutivos '.$mes.'/'.date('Y').'.xls', $this->renderPartial('excel_ranking',array(
                    'tabla'=>$tabla,   
                    ),true));  
                }
                $mesLetras=$this->convertirMes($mes);
                
                 $this->render('rankingMensual',array(
                'tabla'=>$tabla,
                 'mes'=>$mes,
                 'mesLetras'=>$mesLetras,
                ));
                 
               
                 
            }else{
            
              $this->render('rankingMensual');
            }
            
        }
        
        public function actionVerAlertas($rut){
            
            $rutFco="8820971-0";
            $rutEmm="14198477-2";
            $rutAdol="16666225-7";
            
            if(isset($_GET['rut'])){
                $user=  Yii::app()->user->getState("rut");
                $tipoUser=  Yii::app()->user->getState("tipo");        
                
                if($tipoUser=="jefe de venta"){
                $sql="select nombre_jv,nombre_sup,nombre_ejecutivo,nombre_empresa,rut_empresa,cantidad_trabajadores,date(fecha_cambio_estado)as fecha_cambio_estado,estado from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_jv='$user'";
                $devueltas =  Yii::app()->db->createCommand($sql)->queryAll();  
                
                $this->render('detalleDevueltas',array(
                 'devueltas'=>$devueltas,
                 'rut'=>$user));
                
                }elseif($tipoUser=="supervisor"){
                $sql="select nombre_jv,nombre_sup,nombre_ejecutivo,nombre_empresa,rut_empresa,cantidad_trabajadores,date(fecha_cambio_estado)as fecha_cambio_estado,estado from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_sup='$user'";
                $devueltas =  Yii::app()->db->createCommand($sql)->queryAll();
                
                $this->render('detalleDevueltas',array(
                 'devueltas'=>$devueltas,
                 'rut'=>$user));
                
                }elseif($tipoUser=="gerente"){
                    $totalDevSda=0;
                    $totalDevAdh=0;
                 //resumen de jefes de venta cantidad total solictudes y adherentes 
                    $jefesVenta=Array($rutFco,$rutEmm,$rutAdol);
                    $tablaResumenJV=array();
                    foreach($jefesVenta as $jefesv){
                    $sql1="select nombre_jv from solicitud_contrato where rut_jv='$jefesv'";
                    $sql2="select count(rut_empresa) from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_jv='$jefesv' and
                           date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                    $sql3="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_jv='$jefesv' and
                           date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                    $nombreJV=Yii::app()->db->createCommand($sql1)->queryScalar();
                    $cantDevueltasJV =  Yii::app()->db->createCommand($sql2)->queryScalar();
                    $cantDevueltasJVadh =  Yii::app()->db->createCommand($sql3)->queryScalar();
                  //sumando totales
                    $totalDevSda=$totalDevSda+$cantDevueltasJV;
                    $totalDevAdh=$totalDevAdh+$cantDevueltasJVadh;      
                    $datos="<tr><td>$nombreJV</td><td>$cantDevueltasJV</td><td>$cantDevueltasJVadh</td></tr>";
                    $tablaResumenJV[]=$datos;
                    }
                    $tablaResumenJV[]="<tr style='background-color:#CED8F6; font-weight:bold;'><td>Total</td><td>$totalDevSda</td><td>$totalDevAdh</td></tr>";
                
                  //RESUMEN POR CADA SUPERVISOR
                    
                    $tablasSupFCO=$this->tablaDevueltasSupervisores($rutFco);
                    $tablasSupEMM=$this->tablaDevueltasSupervisores($rutEmm);
                    $tablasSupADOL=$this->tablaDevueltasSupervisores($rutAdol);
                    
                //tabla dinamica muestra cada una de las devueltas   
                $sql="select nombre_jv,nombre_sup,nombre_ejecutivo,nombre_empresa,rut_empresa,cantidad_trabajadores,date(fecha_cambio_estado)as fecha_cambio_estado,estado from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and
                      date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                $devueltas =  Yii::app()->db->createCommand($sql)->queryAll();
                
                $this->render('detalleDevueltas',array(
                 'devueltas'=>$devueltas,
                 'rut'=>$user,
                 'tablaResumenJV'=>$tablaResumenJV,
                    'tablasSupFCO'=>$tablasSupFCO,
                    'tablasSupEMM'=>$tablasSupEMM,
                    'tablasSupADOL'=>$tablasSupADOL));
                }
                
                 
            }
            
        }
        
        public function tablaDevueltasSupervisores($rutJv){
            
                    $tablaResumenSup=array();
                    $a=array();
                    $totalDevSdaSup=0;
                    $totalDevAdhSup=0;            
                     //seleccionando los rut de supervisores respecto al rut de jv dado como parametro       
                    $sql="select rut from usuario where rut_padre='$rutJv'";
                    $rutSup=Yii::app()->db->createCommand($sql)->queryAll();
                    
                    foreach($rutSup as $data){
                       $a[]= $data['rut'];
                    }
                    foreach($a as $rutSuperv){
                    $sql11="select CONCAT(nombre,' ', apellido) from usuario where rut='$rutSuperv'";
                    $sql22="select estado from usuario where rut='$rutSuperv'";
                    $sql33="select count(rut_empresa) from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_sup='$rutSuperv' and
                            date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                    $sql44="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where (estado='Devuelta' or estado='Devuelta OPC') and rut_sup='$rutSuperv' and
                            date(fecha_cambio_estado) < DATE(DATE_SUB(NOW(), INTERVAL 2 DAY))";
                    $nombreSup=Yii::app()->db->createCommand($sql11)->queryScalar();
                    $estadoSup=Yii::app()->db->createCommand($sql22)->queryScalar();
                    $cantDevueltasJVSup =  Yii::app()->db->createCommand($sql33)->queryScalar();
                    $cantDevueltasJVadhSup =  Yii::app()->db->createCommand($sql44)->queryScalar();
                  //sumando totales
                    $totalDevSdaSup=$totalDevSdaSup+$cantDevueltasJVSup;
                    $totalDevAdhSup=$totalDevAdhSup+$cantDevueltasJVadhSup;      
                    $datosSup="<tr><td>$nombreSup</td><td>$estadoSup</td><td>$cantDevueltasJVSup</td><td>$cantDevueltasJVadhSup</td></tr>";
                    $tablaResumenSup[]=$datosSup;
                    }
                    $tablaResumenSup[]="<tr style='font-weight:bold;'><td colspan='2'>Total</td><td>$totalDevSdaSup</td><td>$totalDevAdhSup</td></tr>";
        
                    return $tablaResumenSup;
                    
             }
             
             
         public function actionRankingEmpresas(){
            
            if(isset($_GET['mes'])){
                $mes=$_GET['mes'];
                date_default_timezone_set('UTC');
                $year=date("Y");
                
                 $sql="select nombre_jv,nombre_sup,nombre_ejecutivo,rut_empresa,nombre_empresa,cantidad_trabajadores,estado from solicitud_contrato where MONTH(fecha_cambio_estado)= '$mes' and YEAR(fecha_cambio_estado)='$year' order by cantidad_trabajadores desc";
                 $empresas=Yii::app()->db->createCommand($sql)->queryAll();
                 $mesLetras=$this->convertirMes($mes);
                
                  if(isset($_GET['excel'])=='1'){
                    Yii::app()->request->sendFile('excel_rankingEmpresas '.$mes.'/'.date('Y').'.xls', $this->renderPartial('excel_rankingEmpresas',array(
                    'empresas'=>$empresas,
                    'mes'=>$mes,
                    'mesLetras'=>$mesLetras     
                    ),true));  
                }
                 $this->render('rankingEmpresas',array(
                'empresas'=>$empresas,
                'mes'=>$mes,
                'mesLetras'=>$mesLetras     
                         ));
            }else{
            
              $this->render('rankingEmpresas');
            }
            
        }
        
        
}
