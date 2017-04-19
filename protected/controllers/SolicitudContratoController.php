<?php

class SolicitudContratoController extends Controller
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
				'actions'=>array('index','create','update','delete','admin','view','update_estado','update_estadoUno','reporte','supervisorPorJV','ejecutivoPorSup','reporteDetalladoMensual','selecReportes','reportePrueba','crearMemo','reporteNumerosEjecutivos','buscar'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="administrador"',
                               
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','admin','view'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="supervisor"',
                               
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','admin','view'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="jefe de venta"',
                               
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
           $model2=new SolicitudContrato();
            $this->render('view',array(
			'model'=>$this->loadModel($id),
                        'model2'=>$model2
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
        public function agregaNombreEjecutivo($rut_ejecutivo){
            
            $nombre="select nombre from usuario where rut='$rut_ejecutivo'";
            $apellido="select apellido from usuario where rut='$rut_ejecutivo'";
            $nombre_ejecutivo =  Yii::app()->db->createCommand($nombre)->queryScalar();
            $apellido_ejecutivo =  Yii::app()->db->createCommand($apellido)->queryScalar();
            
            $nombre_completo=$nombre_ejecutivo." ".$apellido_ejecutivo;
            
            return $nombre_completo;
        }
         public function agregaNombreSupervisor($rut_supervisor){
            
            $nombre="select nombre from usuario where rut='$rut_supervisor'";
            $apellido="select apellido from usuario where rut='$rut_supervisor'";
            $nombre_supervisor =  Yii::app()->db->createCommand($nombre)->queryScalar();
            $apellido_supervisor =  Yii::app()->db->createCommand($apellido)->queryScalar();
            
            $nombre_completo=$nombre_supervisor." ".$apellido_supervisor;
            
            return $nombre_completo;
        }
         public function agregaNombreJefeVenta($rut_jv){
            
            $nombre="select nombre from usuario where rut='$rut_jv'";
            $apellido="select apellido from usuario where rut='$rut_jv'";
            $nombre_jv =  Yii::app()->db->createCommand($nombre)->queryScalar();
            $apellido_jv =  Yii::app()->db->createCommand($apellido)->queryScalar();
            
            $nombre_completo=$nombre_jv." ".$apellido_jv;
            
            return $nombre_completo;
        }
        
        
	public function actionCreate()
	{
		$model=new SolicitudContrato;
                $registros= new RegistroContratos;

		// Uncomment the following line if AJAX validation is needed
                 $this->performAjaxValidation($model);

		if(isset($_POST['SolicitudContrato']))
		{
                    //rescatmos rut de la empresa que se guardara
                    $rut_emp=$_POST['SolicitudContrato']['rut_empresa'];
                    
			$model->attributes=$_POST['SolicitudContrato'];
                        $model->fecha_ingreso = new CDbExpression('NOW()');
                        $model->fecha_cambio_estado = new CDbExpression('NOW()');
                        $model->rut_solicitante =  Yii::app()->user->getState("rut");
                        $model->usuario_web =  Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido");
                        $model->estado = "En revision";
                        $model->cantidad_rechazada = 0;
                        $model->nombre_ejecutivo=$this->agregaNombreEjecutivo($_POST['SolicitudContrato']['rut_ejecutivo']);
                        $model->nombre_sup=$this->agregaNombreSupervisor($_POST['SolicitudContrato']['rut_sup']);
                        $model->nombre_jv=$this->agregaNombreJefeVenta($_POST['SolicitudContrato']['rut_jv']);
                        $model->nro_memo=0;
                        
                        $registros->rut_empresa=$_POST['SolicitudContrato']['rut_empresa'];
                        $registros->nombre_empresa=$_POST['SolicitudContrato']['nombre_empresa'];
                        $registros->rut_usuario= Yii::app()->user->getState("rut");
                        $registros->tipo_solicitud=$_POST['SolicitudContrato']['tipo_contrato'];
                        $registros->fecha= new CDbExpression('NOW()');
                        $registros->estado="En revision";
                                
			if($model->save()&& $registros->save())
                        
                        $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function ActualizaNombres($id){
            
            $Sq="select rut_ejecutivo from solicitud_contrato where id=$id";
            $rut_ejecutivo=Yii::app()->db->createCommand($Sq)->queryScalar();
            
            $sql1="select rut_padre from usuario where rut='$rut_ejecutivo'";
            $rut_sup=Yii::app()->db->createCommand($sql1)->queryScalar();
            if($rut_sup!==null){
             $sql2="select nombre from usuario where rut='$rut_sup'";
             $nombre_sup=Yii::app()->db->createCommand($sql2)->queryScalar();
             $sql66="select apellido from usuario where rut='$rut_sup'";
             $apellido_sup=Yii::app()->db->createCommand($sql66)->queryScalar();
            }
            //jefe venta
             $sql12="select rut_padre from usuario where rut='$rut_sup'";
            $rut_jv=Yii::app()->db->createCommand($sql12)->queryScalar();
            if($rut_jv!==null){
             $sql22="select nombre from usuario where rut='$rut_jv'";
             $nombre_jv=Yii::app()->db->createCommand($sql22)->queryScalar();
              $sql666="select apellido from usuario where rut='$rut_jv'";
             $apellido_jv=Yii::app()->db->createCommand($sql666)->queryScalar();
        
            }
            $nombre_superv=$nombre_sup." ".$apellido_sup;
            $nombre_jefev=$nombre_jv." ".$apellido_jv;
           
            if($nombre_sup!==null && $nombre_jv!==null){
             $sql3="update solicitud_contrato set rut_sup='$rut_sup',nombre_sup='$nombre_superv',rut_jv='$rut_jv',nombre_jv='$nombre_jefev' "
                     ."where rut_ejecutivo='$rut_ejecutivo'";
             Yii::app()->db->createCommand($sql3)->execute();
                
            }  
        }
        
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
		if(isset($_POST['SolicitudContrato']))
		{
                        //$this->ActualizaNombres($model->id);
                       
                        //aca iba
			if($model->fecha_cambio_estado!==$_POST['SolicitudContrato']['fecha_cambio_estado']
                                
                                ||$model->comentario_fech_vali!==$_POST['SolicitudContrato']['fecha_cambio_estado']){
                            $auditoria=new RegistroContratos();
                            
                            if($_POST['SolicitudContrato']['comentario_fech_vali']!==" "){
                            $auditoria->rut_empresa=$model->rut_empresa;
                            $auditoria->nombre_empresa=$model->nombre_empresa;
                            $auditoria->rut_usuario=Yii::app()->user->getState('rut');
                            $auditoria->fecha=new CDbExpression('NOW()');
                            $auditoria->tipo_solicitud=$_POST['SolicitudContrato']['tipo_contrato'];
                            $auditoria->estado=$model->estado;
                            $auditoria->comentario_fech_vali=$_POST['SolicitudContrato']['comentario_fech_vali'];
                            $auditoria->save();
                            }
                        }
                        $model->attributes=$_POST['SolicitudContrato'];
                        $model->nombre_ejecutivo=$this->agregaNombreEjecutivo($_POST['SolicitudContrato']['rut_ejecutivo']);
                        $model->nombre_sup=$this->agregaNombreSupervisor($_POST['SolicitudContrato']['rut_sup']);
                        $model->nombre_jv=$this->agregaNombreJefeVenta($_POST['SolicitudContrato']['rut_jv']);
                        if($model->save())
                        $this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionUpdate_estado($id)
	{
		$model=$this->loadModel($id);
                $registros= new RegistroContratos;
                $registro_fecha= new RegistroFechaIngreso;
                $sql="update solicitud_contrato set comentario_fech_vali=' ' where id=$id";
                
                date_default_timezone_set('UTC');
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SolicitudContrato']))
		{
                     $rut_emp=$_POST['SolicitudContrato']['rut_empresa'];
                     $model->attributes=$_POST['SolicitudContrato'];
                     $model->usuario_web =  Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido"); 
                     $model->comentario_fech_vali=".";
                     $registros->estado=$_POST['SolicitudContrato']['estado'];
                     $registros->comentario_fech_vali="Cambio por sistema";
                     $registros->tipo_solicitud=$_POST['SolicitudContrato']['tipo_contrato'];
                     
                          if($_POST['SolicitudContrato']['estado']==="En revision"){
                           
                            $model->fecha_cambio_estado=new CDbExpression('NOW()');
                            $registro_fecha->id_registro=$model->id;
                            $registro_fecha->fecha_ingreso=$model->fecha_cambio_estado;
                       
                            $registro_fecha->save(); 
                          }
                        $model->fecha_cambio_estado=new CDbExpression('NOW()');
                        
                     if($_POST['SolicitudContrato']['estado']==="Completa"){
                          
                        $numero_memo=$_POST['SolicitudContrato']['nro_memo'];
                        $nro_memoCeros=str_pad($numero_memo, 5, "0", STR_PAD_LEFT);
                        $model->nro_memo=$nro_memoCeros."-".date("Y");
                        }
                        $registros->rut_empresa=$_POST['SolicitudContrato']['rut_empresa'];
                        $registros->nombre_empresa=$_POST['SolicitudContrato']['nombre_empresa'];
                        $registros->tipo_solicitud=$_POST['SolicitudContrato']['tipo_contrato'];
                        $registros->rut_usuario= Yii::app()->user->getState("rut");      
                        $registros->fecha= new CDbExpression('NOW()');
                       
                        if($_POST['SolicitudContrato']['estado']==="Devuelta"){
                         $model->cantidad_rechazada = $model->cantidad_rechazada+1;  
                            
                        }
			if($model->save()&& $registros->save())
                             
                            Yii::app()->db->createCommand($sql)->execute();
                            $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update_estado',array(
			'model'=>$model,
		));
	}
        
        public function actionUpdate_estadoUno($id)
	{
            $model=$this->loadModel($id);
            $registros= new RegistroContratos;
            
		if(isset($_GET['id']))
		{
                    $id=$_GET['id'];
                    $sql="update solicitud_contrato set fecha_cambio_estado=NOW(),estado='Ingresada' where id=$id";
                    $consulta=  Yii::app()->db->createCommand($sql)->execute();
                    
                        $registros->rut_empresa=$model->rut_empresa;
                        $registros->nombre_empresa=$model->nombre_empresa;
                        $registros->rut_usuario= $model->rut_solicitante;   
                        $registros->fecha= new CDbExpression('NOW()');
                        $registros->estado='Ingresada';
                        $registros->save();
                    $this->redirect(array('admin'));    
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
         * array("condition"=>"':email_id'=$id"
	 */
	public function actionIndex()
	{
             date_default_timezone_set('UTC');
             if(!empty($_POST['RangoFechas']['fecha_inicio']) && !empty($_POST['RangoFechas']['fecha_fin'])){
                 $fech1=$_POST['RangoFechas']['fecha_inicio']." 00:00:00";
                 $fech2=$_POST['RangoFechas']['fecha_fin']." 23:59:59";
                 
             $sql="select * from solicitud_contrato where fecha_cambio_estado between '$fech1' and '$fech2'";
             $modelfech = Yii::app()->db->createCommand($sql)->queryAll();
             }else{
                
                $modelfech=  SolicitudContrato::model()->findAll(); 
             }
             Yii::app()->request->sendFile('reporte '.date("d-m-Y").'.xls', $this->renderPartial('excel',array(
                'modelfech'=>$modelfech,
             ),true));      
	}

        public function actionReporte()
	{
            if( Yii::app()->user->getState("tipo")==="administrador"){
            //REPORTE TOTAL DE SOLICITUDES
            $sql1="select count(rut_empresa)from solicitud_contrato where estado='Completa'";
            $sql2="select count(rut_empresa)from solicitud_contrato where estado='Devuelta'";
            $sql3="select count(rut_empresa)from solicitud_contrato where estado='En revision'";
            $sql4="select sum(cantidad_trabajadores)from solicitud_contrato where estado='Completa'";
            $sql5="select sum(cantidad_trabajadores)from solicitud_contrato where estado='Devuelta'";
            $sql6="select sum(cantidad_trabajadores)from solicitud_contrato where estado='En revision'";
            $TotalCompletas = Yii::app()->db->createCommand($sql1)->queryScalar();
            $TotalIncompletas = Yii::app()->db->createCommand($sql2)->queryScalar();
            $TotalIngresadas = Yii::app()->db->createCommand($sql3)->queryScalar();
            $SumaCompletas = Yii::app()->db->createCommand($sql4)->queryScalar();
            $SumaIncompletas = Yii::app()->db->createCommand($sql5)->queryScalar();
            $SumaIngresadas = Yii::app()->db->createCommand($sql6)->queryScalar();
            $TotGeneralEmpresas=$TotalCompletas+$TotalIncompletas+$TotalIngresadas;
            $totGeneralTrab=$SumaCompletas+$SumaIncompletas+$SumaIngresadas;
            
            //REPORTE DIARIO DE SOLICITUDES
            
            $sql11="select count(rut_empresa)from solicitud_contrato where estado='Completa'";
            $sql22="select count(rut_empresa)from solicitud_contrato where estado='Devuelta'";
            $sql33="select count(rut_empresa)from solicitud_contrato where estado='En revision'";
            $sql44="select sum(cantidad_trabajadores)from solicitud_contrato where estado='Completa'";
            $sql55="select sum(cantidad_trabajadores)from solicitud_contrato where estado='Devuelta'";
            $sql66="select sum(cantidad_trabajadores)from solicitud_contrato where estado='En revision'";
            $TotalCompletasRD = Yii::app()->db->createCommand($sql11)->queryScalar();
            $TotalIncompletasRD = Yii::app()->db->createCommand($sql22)->queryScalar();
            $TotalIngresadasRD = Yii::app()->db->createCommand($sql33)->queryScalar();
            $SumaCompletasRD = Yii::app()->db->createCommand($sql44)->queryScalar();
            $SumaIncompletasRD = Yii::app()->db->createCommand($sql55)->queryScalar();
            $SumaIngresadasRD = Yii::app()->db->createCommand($sql66)->queryScalar();
            
            $TotGeneralEmpresas=$TotalCompletas+$TotalIncompletas+$TotalIngresadas;
            $totGeneralTrab=$SumaCompletas+$SumaIncompletas+$SumaIngresadas;
            //REPORTE DIARIO -1 DE SOLICITUDES
             
             date_default_timezone_set('UTC');
             
             Yii::app()->request->sendFile('reporte actual '.date("d-m-y").'.xls', $this->renderPartial('excelReporteTotalSolicitudes',array(
                 'TotalCompletas'=>$TotalCompletas,
                 'TotalIncompletas'=>$TotalIncompletas,
                 'TotalIngresadas'=>$TotalIngresadas,
                 'SumaCompletas'=>$SumaCompletas,
                 'SumaIncompletas'=>$SumaIncompletas,
                 'SumaIngresadas'=>$SumaIngresadas,
                 'TotGeneralEmpresas'=>$TotGeneralEmpresas,
                 'totGeneralTrab'=>$totGeneralTrab
             ),true));
             
            }
        }
        
        
        public function actionSelecReportes(){
		$this->render('view_reportes');
        }
        
        
        public function actionReporteDetalladoMensual($mes){
            
            //META CONSTANTE
            (int)$metaSDA=8*48;
            (int)$metaADH=121*48;
            
             if($mes==="01"){
             $month="Enero";
            }elseif($mes==="02"){
             $month="Febrero";   
            }elseif($mes==="03"){
             $month="Marzo";   
            }elseif($mes==="04"){
             $month="Abril";   
            }elseif($mes==="05"){
             $month="Mayo";   
            }elseif($mes==="06"){
             $month="Junio";   
            }elseif($mes==="07"){
             $month="Julio";   
            }elseif($mes==="08"){
             $month="Agosto";   
            }elseif($mes==="09"){
             $month="Septiembre";   
            }elseif($mes==="10"){
             $month="Octubre";   
            }elseif($mes==="11"){
             $month="Noviembre";   
            }elseif($mes==="12"){
             $month="Diciembre";   
            }
            //PRIMERA TABLA REPORTE GENERAL DE SDA Y ADH
            
            //FRANCISCO
            $plsqlFco1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlFco6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
            
            (int)$fcoTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlFco1)->queryScalar();
            (int)$fcoTotalSDACompletas=    Yii::app()->db->createCommand($plsqlFco2)->queryScalar();
            (int)$fcoTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlFco3)->queryScalar();
            (int)$fcoTotalADHRevision=  Yii::app()->db->createCommand($plsqlFco4)->queryScalar();
            (int)$fcoTotalADHCompletas=  Yii::app()->db->createCommand($plsqlFco5)->queryScalar();
            (int)$fcoTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlFco6)->queryScalar();
            
            //EMMANUEL
            
            $plsqlEm1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlEm6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
            
            (int)$EmTotalSDAEnRevision=   Yii::app()->db->createCommand($plsqlEm1)->queryScalar();
            (int)$EmTotalSDACompletas=    Yii::app()->db->createCommand($plsqlEm2)->queryScalar();
            (int)$EmTotalSDADevueltas=  Yii::app()->db->createCommand($plsqlEm3)->queryScalar();
            (int)$EmTotalADHRevision=  Yii::app()->db->createCommand($plsqlEm4)->queryScalar();
            (int)$EmTotalADHCompletas=  Yii::app()->db->createCommand($plsqlEm5)->queryScalar();
            (int)$EmTotalADHDevueltas=  Yii::app()->db->createCommand($plsqlEm6)->queryScalar();
            
            //ADOLFO
            $plsqlAd1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd4="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsqlAd6="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
            
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
            $plsql1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            $plsql2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
            (int)$factorTotalSDA=   Yii::app()->db->createCommand($plsql1)->queryScalar();
            (int)$factorTotalADH=   Yii::app()->db->createCommand($plsql2)->queryScalar();
            
            //francisco
            $plsql1fco="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes and rut_jv='8820971-0'";
            $plsql2fco="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes and rut_jv='8820971-0'";
            (int)$fcoCompletasSDA= Yii::app()->db->createCommand($plsql1fco)->queryScalar();
            (int)$fcoCompletasADH= Yii::app()->db->createCommand($plsql2fco)->queryScalar();
            
            //Emmanuel
             $plsql1Em="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes and rut_jv='14198477-2'";
            $plsql2Em="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes and rut_jv='14198477-2'";
            (int)$EmCompletasSDA= Yii::app()->db->createCommand($plsql1Em)->queryScalar();
            (int)$EmCompletasADH= Yii::app()->db->createCommand($plsql2Em)->queryScalar();
            
            //Adolfo
            $plsql1Ad="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes and rut_jv='16666225-7'";
            $plsql2Ad="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes and rut_jv='16666225-7'";
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
          $sqlFcoSDA1="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoSDA2="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoSDA3="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH1="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH2="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFcoADH3="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
          
          $sqlFco4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' and MONTH(fecha_cambio_estado)= $mes";
          $sqlFco5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '8820971-0' and MONTH(fecha_cambio_estado)= $mes";
          
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
          
          $sqlEm1SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm2SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm3SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm1ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm2ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
          $sqlEm3ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
          
          
          
          $sqlEm4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' and MONTH(fecha_cambio_estado)= $mes"; 
          $sqlEm5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '14198477-2' and MONTH(fecha_cambio_estado)= $mes";
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
          
          $sqlAd1SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd2SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd3SDA="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd1ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'En revision' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd2ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Completa' and MONTH(fecha_cambio_estado)= $mes";
          $sqlAd3ADH="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' AND estado = 'Devuelta' and MONTH(fecha_cambio_estado)= $mes";
          
          $sqlAd4="SELECT COUNT( rut_empresa ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' and MONTH(fecha_cambio_estado)= $mes"; 
          $sqlAd5="SELECT IFNULL( SUM( cantidad_trabajadores ) , 0 ) FROM solicitud_contrato WHERE rut_jv = '16666225-7' and MONTH(fecha_cambio_estado)= $mes";
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
                 $sql2="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='En revision' and rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas = Yii::app()->db->createCommand($sql2)->queryScalar();
                 $sql3="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Completa' and rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                (int) $cantidadCompletas = Yii::app()->db->createCommand($sql3)->queryScalar();
                 $sql4="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Devuelta' and rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                (int) $cantidadIncompletas = Yii::app()->db->createCommand($sql4)->queryScalar();
                 
                 $sql5="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado='En revision' and rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadasADH = Yii::app()->db->createCommand($sql5)->queryScalar();
                 $sql6="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado='Completa' and rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletasADH = Yii::app()->db->createCommand($sql6)->queryScalar();
                 $sql7="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado='Devuelta' and rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletasADH = Yii::app()->db->createCommand($sql7)->queryScalar();
               
                 
                 $sql8="select count(rut_empresa) from solicitud_contrato where rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalEmpresas = Yii::app()->db->createCommand($sql8)->queryScalar();
                 $sql9="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rut' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalTrabajadores = Yii::app()->db->createCommand($sql9)->queryScalar();
                 
                 $tableFco[]="<td>$nombres_sup</td><td>$cantidadTotalEmpresas</td><td>$cantidadTotalTrabajadores</td><td>$cantidadIngresadas</td><td>$cantidadIngresadasADH</td><td>$cantidadCompletas</td><td>$cantidadCompletasADH</td><td>$cantidadIncompletas</td><td>$cantidadIncompletasADH</td>"; 
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
                 
                 $sql22="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='En revision' and rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas2 = Yii::app()->db->createCommand($sql22)->queryScalar();
                 $sql32="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Completa' and rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas2 = Yii::app()->db->createCommand($sql32)->queryScalar();
                 $sql42="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Devuelta' and rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas2 = Yii::app()->db->createCommand($sql42)->queryScalar();
                 $sql52="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado='En revision' and rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas2ADH = Yii::app()->db->createCommand($sql52)->queryScalar();
                 $sql62="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado='Completa' and rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas2ADH = Yii::app()->db->createCommand($sql62)->queryScalar();
                 $sql72="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) as q_empresas from solicitud_contrato where estado='Devuelta' and rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas2ADH = Yii::app()->db->createCommand($sql72)->queryScalar();
                 
                 $sql82="select count(rut_empresa) from solicitud_contrato where rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalEmpresas2 = Yii::app()->db->createCommand($sql82)->queryScalar();
                 $sql92="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rutEm1' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalTrabajadores2 = Yii::app()->db->createCommand($sql92)->queryScalar();
                 
                 $tableEmm[]="<td>$nombres_sup2</td><td>$cantidadTotalEmpresas2</td><td>$cantidadTotalTrabajadores2</td><td>$cantidadIngresadas2</td><td>$cantidadIngresadas2ADH</td><td>$cantidadCompletas2</td><td>$cantidadCompletas2ADH</td><td>$cantidadIncompletas2</td><td>$cantidadIncompletas2ADH</td>"; 
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
                 $sql23="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='En revision' and rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                (int) $cantidadIngresadas3 = Yii::app()->db->createCommand($sql23)->queryScalar();
                 $sql33="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Completa' and rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadCompletas3 = Yii::app()->db->createCommand($sql33)->queryScalar();
                 $sql43="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Devuelta' and rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas3 = Yii::app()->db->createCommand($sql43)->queryScalar();
                 $sql53="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='En revision' and rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIngresadas3ADH = Yii::app()->db->createCommand($sql53)->queryScalar();
                 $sql63="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Completa' and rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                (int) $cantidadCompletas3ADH = Yii::app()->db->createCommand($sql63)->queryScalar();
                 $sql73="select count(rut_empresa) as q_empresas from solicitud_contrato where estado='Devuelta' and rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadIncompletas3ADH = Yii::app()->db->createCommand($sql73)->queryScalar();
                 
                 
                 $sql83="select count(rut_empresa) from solicitud_contrato where rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalEmpresas3 = Yii::app()->db->createCommand($sql83)->queryScalar();
                 $sql93="select IFNULL( SUM( cantidad_trabajadores ) , 0 ) from solicitud_contrato where rut_sup='$rutAdo2' and MONTH(fecha_cambio_estado)= $mes";
                 (int)$cantidadTotalTrabajadores3 = Yii::app()->db->createCommand($sql93)->queryScalar();
                 
                 $tableAdolfo[]="<td>$nombres_sup3</td><td>$cantidadTotalEmpresas3</td><td>$cantidadTotalTrabajadores3</td><td>$cantidadIngresadas3</td><td>$cantidadIngresadas3ADH</td><td>$cantidadCompletas3</td><td>$cantidadCompletas3ADH</td><td>$cantidadIncompletas3</td><td>$cantidadIncompletas3ADH</td>"; 
                 }  
                  date_default_timezone_set('UTC');
                 Yii::app()->request->sendFile('Reporte mensual detallado '.$month.'del '.date("Y").'.xls', $this->renderPartial('excelReporte_MensualDetallado',array(
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
                 'month'=>$month,   
                     
                     
             ),true));
        }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SolicitudContrato('search_2');
                $memo=new Memo();
                $modelfecha=new RangoFechas();
                $buscar=new Buscar();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitudContrato']))
			$model->attributes=$_GET['SolicitudContrato'];

		$this->render('admin',array(
			'model'=>$model,
                        'memo'=>$memo,
                        'modelfecha'=>$modelfecha,
                        'buscar'=>$buscar,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SolicitudContrato the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SolicitudContrato::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SolicitudContrato $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitud-contrato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		} 
	}
        
       public function actionSupervisorPorJV()
        {
            $tipo = $_POST['SolicitudContrato']['rut_jv'];
            
            $list= Usuario::model()->findAll("rut_padre=? and estado='Activo'",array($tipo));
            echo CHtml::tag('option', array('value' => ''), 'Seleccione un supervisor', true);
            
           foreach($list as $data){
               //echo "<option value=''selected='selected'>Seleccione</option>";
               echo "<option value=\"{$data->rut}\">{$data->nombre} {$data->apellido}</option>";
               
           }
        }
        
           public function actionEjecutivoPorSup()
        {
            $tipo = $_POST['SolicitudContrato']['rut_sup'];
            
            $list= Usuario::model()->findAll("rut_padre=? and estado='Activo'",array($tipo));
            echo CHtml::tag('option', array('value' => ''), 'Seleccione un ejecutivo', true);
           foreach($list as $data){
               //echo "<option value=''selected='selected'>Make a choice</option>";
               echo "<option value=\"{$data->rut}\">{$data->nombre} {$data->apellido}</option>";
               
           }
        }
        public function actionCrearMemo()
	{
            if( Yii::app()->user->getState("tipo")==="administrador"){
                
                if(isset($_POST['Memo']['numero_memo'])){   
                   //REPORTE TOTAL DE SOLICITUDES            
                $memo=$_POST['Memo']['numero_memo'];
                
                $sql="select fecha_solicitud,tipo_contrato,rut_empresa,nombre_empresa,nombre_ejecutivo,vigencia from solicitud_contrato where nro_memo='$memo'";
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
        
        public function actionBuscar(){
           
            if(isset($_POST['Buscar']['rut']))
            $rut=str_replace(".","",$_POST['Buscar']['rut']);
            
            $op=$_POST['Buscar']['op'];
            $where="";
            
            if($op=="1"){$where="rut_jv='$rut'";}elseif($op=="2"){$where="rut_sup='$rut'";}elseif($op=="3"){$where="rut_ejecutivo='$rut'";}
            
            $sql="select * from solicitud_contrato where $where";
            $modelfech = Yii::app()->db->createCommand($sql)->queryAll();
            
            Yii::app()->request->sendFile('reporte produccion '.date("d-m-y").'.xls', $this->renderPartial('excel',array(
                'modelfech'=>$modelfech,
            ),true));   
        }
        
        
      
        
        
        
}