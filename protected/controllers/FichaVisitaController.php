<?php

class FichaVisitaController extends Controller
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
				'actions'=>array('index','create','update','delete','admin','view','reporte','reporteTable','contarVisitas','detalleEjecutivo','reporteVisitas','detalleEmpresa','alertasCierres','viewEmpresa','datosExcel'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="administrador"',
                               
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete','admin','view','contarVisitas','detalleEjecutivo','reporteVisitas','detalleEmpresa','alertasCierres','viewEmpresa','alertasJSON','datosExcel'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="gerente"',
                               
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','delete','admin','view','contarVisitasSup','detalleEjecutivo','detalleEmpresa','alertasCierres','viewEmpresa'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="supervisor"',
                               
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','admin','view','update','reporte','reporteTable','contarVisitas','detalleEjecutivo','reporteVisitas','detalleEmpresa','alertasCierres','viewEmpresa','datosExcel'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
        public function getUltimoDiaHabil($fecha){
                         
                        //letra N = lunes 1 domingo 7
                        $dia=date("N", strtotime($fecha));

                        if($dia=="1"){ 
                            //Lunes
                            $nuevafecha = strtotime ("-2 day" , strtotime ( $fecha ) ); 
                            $nuevafecha = date ( 'Y-m-d' , $nuevafecha ); //formatea nueva fecha 
                            return $nuevafecha;
                        }else{
                            $nuevafecha = strtotime ("-1 day" , strtotime ( $fecha ) ); 
                            $nuevafecha = date ( 'Y-m-d' , $nuevafecha ); //formatea nueva fecha 
                            return $nuevafecha; 
                        }
        }
        
	public function actionCreate()
	{
              //$hola=$this->getUltimoDiaHabil(new CDbExpression('NOW()'));
		$model=new FichaVisita;
                date_default_timezone_set('UTC');
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['FichaVisita']))
		{
                        $rut_supervisor=Yii::app()->user->getState("rut");
                        
			$model->attributes=$_POST['FichaVisita'];
                        $model->nombre_empresa=strtolower($_POST['FichaVisita']['nombre_empresa']);
                        $model->nombre_contacto= strtolower($_POST['FichaVisita']['nombre_contacto']);
                        $model->rut_jv=$model->getRutJV($rut_supervisor);
                        $model->nombre_jv=$model->getNombreJefVenta($rut_supervisor);
                        $model->rut_sup=$rut_supervisor;
                        $rutFormat=str_replace(".","",$_POST['FichaVisita']['rut_empresa']);
                        $model->rut_empresa=$rutFormat;
                        $model->nombre_sup=Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido");
                        $model->nombre_eje=$model->getNombreEjecu($_POST['FichaVisita']['rut_eje']);
                        $model->fecha_ingreso=new CDbExpression('NOW()');
                        
                        $model->usuario_web=$model->nombre_sup;
                        $model->estado="Vigente";
                        $model->fech_vencimiento = $model->sumarMes($_POST['FichaVisita']['fecha_visita']);
                        
                        //resumen de la cantidad de respuestas de la ficha autoevaluación
                        $totalCumple=0;
                        $totalNoCumple=0;
                        $totalNoAplica=0;
                        
                        $respuestas=array(
                                $_POST['FichaVisita']['GTL1'],
                                $_POST['FichaVisita']['GTL2'],
                                $_POST['FichaVisita']['GTL3'],
                                $_POST['FichaVisita']['GTL4'],
                                $_POST['FichaVisita']['GTL5'],
                                $_POST['FichaVisita']['GTL6'],
                                $_POST['FichaVisita']['GTL7'],
                                $_POST['FichaVisita']['GTL8'],
                                $_POST['FichaVisita']['GTL9']);
                        foreach($respuestas as $res){
                            if($res=="Cumple"){$totalCumple++; }
                            elseif($res=="No cumple"){$totalNoCumple++;}
                            elseif($res=="No aplica"){$totalNoAplica++;}  
                        }
                        //guadando el resumen de respuesta en el campo correspondiente
                        $model->total_cumple=$totalCumple;
                        $model->total_nocumple=$totalNoCumple;
                        $model->total_noaplica=$totalNoAplica;
                        
			if($model->save())
				$this->redirect(array('create','nom'=>$model->nombre_empresa));
		}
               
		$this->render('create',array(
			'model'=>$model,
                        //'hola'=>$hola
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $RegComent = new RegistroComentarios();
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['FichaVisita']))
		{
                       //guardando los comentarios en la tabla registro_comentarios
//                        if($model->fech_pos_cierre!=$_POST['FichaVisita']['fech_pos_cierre']){
//                        
//                            $RegComent->rut_jv = $model->rut_jv;
//                            $RegComent->nombre_jv = $model->nombre_jv;       
//                            $RegComent->rut_sup = $model->rut_sup;       
//                            $RegComent->nombre_sup = $model->nombre_sup;
//                            $RegComent->rut_eje = $model->rut_eje;       
//                            $RegComent->nombre_eje = $model->nombre_eje;
//                            $RegComent->rut_empresa = $model->rut_empresa; 
//                            $RegComent->nombre_empresa = $model->nombre_empresa;
//                            $RegComent->fecha_com_visita = $model->fecha_visita;
//                            $RegComent->com_visita = $model->visita_com;
//                            $RegComent->fecha_com_poscierre = $model->fech_pos_cierre;
//                            $RegComent->com_poscierre = $model->fech_pos_cierre_com;
//                            $RegComent->save();       
//                        }
                        
			$model->attributes=$_POST['FichaVisita'];
                        $model->nombre_empresa=strtolower($_POST['FichaVisita']['nombre_empresa']);
                        $model->nombre_contacto= strtolower($_POST['FichaVisita']['nombre_contacto']);
                        $rutFormat=str_replace(".","",$_POST['FichaVisita']['rut_empresa']);
                        $model->rut_empresa=$rutFormat; 
                        $model->nombre_eje=$model->getNombreEjecu($_POST['FichaVisita']['rut_eje']);
                         $totalCumple=0;
                        $totalNoCumple=0;
                        $totalNoAplica=0;
                        
                        $respuestas=array(
                                $_POST['FichaVisita']['GTL1'],
                                $_POST['FichaVisita']['GTL2'],
                                $_POST['FichaVisita']['GTL3'],
                                $_POST['FichaVisita']['GTL4'],
                                $_POST['FichaVisita']['GTL5'],
                                $_POST['FichaVisita']['GTL6'],
                                $_POST['FichaVisita']['GTL7'],
                                $_POST['FichaVisita']['GTL8'],
                                $_POST['FichaVisita']['GTL9']);
                        foreach($respuestas as $res){
                            if($res=="Cumple"){$totalCumple++; }
                            elseif($res=="No cumple"){$totalNoCumple++;}
                            elseif($res=="No aplica"){$totalNoAplica++;}  
                        }
                        //guadando el resumen de respuesta en el campo correspondiente
                        $model->total_cumple=$totalCumple;
                        $model->total_nocumple=$totalNoCumple;
                        $model->total_noaplica=$totalNoAplica;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
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
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FichaVisita');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
                
            $tipo=Yii::app()->user->getState("tipo");
            $model=new FichaVisita('search');
            //actualiza las autoevaluaciones vencidas
            $model->verificaVencidas();
            if($tipo==="gerente"||$tipo==="administrador"){
                
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FichaVisita']))
			$model->attributes=$_GET['FichaVisita'];

		$this->render('admin',array(
			'model'=>$model
		));
                
            }else{
               if(Yii::app()->user->getState('tipo')=="gerente"||Yii::app()->user->getState('tipo')=="jefe de venta"){
                $this->layout='//layouts/mainReporteBoss';   
            }
            if(isset($_GET['mes'])||isset($_GET['excel'])){
            $mes=$_GET['mes'];
            date_default_timezone_set('UTC');
            $year=date("Y");
            
            $rut_usuario=Yii::app()->user->getState("rut");
            $tipo=Yii::app()->user->getState("tipo");
		$model=new FichaVisita('search');
		$model->unsetAttributes();  // clear any default values
                $where="";
                $tabla=array();
                $a=array();
                
                if($tipo=="supervisor"){
                 $sql="select * from ficha_visita where MONTH(fecha_visita)='$mes' and YEAR(fecha_visita)='$year' and rut_sup='$rut_usuario'";
           
                }
                elseif($tipo=="jefe de venta"){
                    $sql="select * from ficha_visita where MONTH(fecha_visita)='$mes' and YEAR(fecha_visita)='$year' and rut_jv='$rut_usuario'";
                }elseif($tipo=="administrador"){
                    $sql="select * from ficha_visita";
                }
                $registros=Yii::app()->db->createCommand($sql)->queryAll();
                
                     if(isset($_GET['excel'])){
                    date_default_timezone_set('UTC');
                     Yii::app()->request->sendFile('Autoevaluaciones '.date("d-m-Y").'.xls', $this->renderPartial('excelAutoev',array(
                        'model'=>$model,
                        'registros'=>$registros,
                        'mes'=>$mes,
                            
                     ),true));
                    }
                
                    
		if(isset($_GET['FichaVisita']))
			$model->attributes=$_GET['FichaVisita'];

		$this->render('admin',array(
			'model'=>$model,
                        'registros'=>$registros,
                        'mes'=>$mes,
                        'mesConv'=>$this->convertirMes($mes) 
		));
	}else{
           
           $this->render('admin',array()); 
            
            }
                
                
                
            }
        }
    
        public function actionDatosExcel(){
            
             $sql="select * from ficha_visita";
            $registros=Yii::app()->db->createCommand($sql)->queryAll();
                    date_default_timezone_set('UTC');
                     Yii::app()->request->sendFile('Autoevaluaciones '.date("d-m-Y").'.xls', $this->renderPartial('excelAutoev',array(
                        
                        'registros'=>$registros,
                       
                            
                     ),true));
                    
            
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FichaVisita the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FichaVisita::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FichaVisita $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ficha-visita-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionContarVisitas(){
            
            $this->layout='//layouts/mainReporteBoss';
            
            $buscar=new Buscar();
            $x=new FichaVisita();
            $tabla=array();
            date_default_timezone_set('UTC');
            $year=date("Y");
            
            if(isset($_GET['mes'])){
            $mes=$_GET['mes'];
               
//               $oriente=array('Puente Alto'=>'Puente Alto','La Florida'=>'La Florida'
//                        ,'La Reina'=>'La Reina','Las Condes'=>'Las Condes'
//                        ,'Lo Barnechea'=>'Lo Barnechea','Peñalolén'=>'Peñalolén','Providencia'=>'Providencia','Vitacura'=>'Vitacura');
//            
//               $norte=array('Cerro Navia'=>'Cerro Navia','Conchalí'=>'Conchalí','Estación Central'=>'Estación Central'
//                        ,'Huechuraba'=>'Huechuraba','Independencia'=>'Independencia'
//                        ,'Lo Prado'=>'Lo Prado','Pudahuel'=>'Pudahuel','Quilicura'=>'Quilicura','Quinta Normal'=>'Quinta Normal','Recoleta'=>'Recoleta'
//                        ,'Renca'=>'Renca','Santiago'=>'Santiago');
//               
//               $sur=array('San Bernardo'=>'San Bernardo','Cerrillos'=>'Cerrillos','El Bosque'=>'El Bosque'
//                        ,'La Cisterna'=>'La Cisterna','La Granja'=>'La Granja','La Pintana'=>'La Pintana'
//                        ,'Lo Espejo'=>'Lo Espejo','Macul'=>'Macul','Maipú'=>'Maipú'
//                        ,'Ñuñoa'=>'Ñuñoa','Pedro Aguirre Cerda'=>'Pedro Aguirre Cerda','San Miguel'=>'San Miguel'
//                        ,'San Joaquín'=>'San Joaquín','San Ramón'=>'San Ramón','Padre Hurtado'=>'Padre Hurtado');
 
                $sql="select rut from usuario where tipo='ejecutivo' and estado='Activo'";
                $ej=Yii::app()->db->createCommand($sql)->queryAll();

                 foreach($ej as $data2){
                     $a2[]=$data2['rut'];
                 }

                foreach($a2 as $ejecutivo){

                //$list1= $x->getNombreJV($ejecutivo);
                //$list2=$x->getNombreSup($ejecutivo);
               $nombres_jv2 = "select nombre_jv from ficha_visita where rut_eje='$ejecutivo'";
                $list1=Yii::app()->db->createCommand($nombres_jv2)->queryScalar();
                
                $nombres_sup2 = "select nombre_sup from ficha_visita where rut_eje='$ejecutivo'";
                $list2=Yii::app()->db->createCommand($nombres_sup2)->queryScalar();    
                    
                    
                $sql3="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$ejecutivo'";
                $sql4="select count(rut_empresa) as empresas from ficha_visita where rut_eje='$ejecutivo' and MONTH(fecha_visita)= '$mes' and YEAR(fecha_visita)='$year'";
                $sql5="select count(s.rut_empresa) as empresas from ficha_visita f, solicitud_contrato s where f.rut_eje='$ejecutivo' and s.rut_empresa = f.rut_empresa and MONTH(fecha_visita)= '$mes' and YEAR(fecha_visita)='$year'";
                $list3=Yii::app()->db->createCommand($sql3)->queryScalar();
                $list4=Yii::app()->db->createCommand($sql4)->queryScalar();
                $list5=Yii::app()->db->createCommand($sql5)->queryScalar();

                $verEjecutivo=CHtml::link($list3,array('detalleEjecutivo','rut_ejecutivo'=>$ejecutivo,'mes'=>$mes),array('style'=>'color:#0101DF;'));

                $tabla[]="<td></td><td>$list1</td><td>$list2</td><td>$verEjecutivo</td><td>$list4</td><td>$list5</td>";
                }
                $mes1=$this->convertirMes($mes);
                
                   if(isset($_GET['excel'])){
                    date_default_timezone_set('UTC');
                     Yii::app()->request->sendFile('Autoevaluaciones Por ejecutivo '.date("d-m-Y").'.xls', $this->renderPartial('excelAutoevEjecutivo',array(
                       'tabla'=>$tabla,'buscar'=>$buscar,'mes'=>$mes),true));
                    }
                    
                $this->render('reporte',array(
                'tabla'=>$tabla,'buscar'=>$buscar,'mes1'=>$mes1,'mes'=>$mes));
                }else{
                  $this->render('reporte',array(
                  'buscar'=>$buscar));   
             }
            }
            
            public function actionDetalleEjecutivo($rut_ejecutivo,$mes){
                
            $this->layout='//layouts/mainReporteBoss';
            date_default_timezone_set('UTC');
            $year=date("Y");
            
            $sql="SELECT * FROM ficha_visita WHERE rut_eje = '$rut_ejecutivo' and MONTH(fecha_visita)= $mes and YEAR(fecha_visita)='$year'";
            $detalle=Yii::app()->db->createCommand($sql)->queryAll();
            
            $this->render('detalleEjecutivo',array(
                'detalle'=>$detalle,
                'rut_ejecutivo'=>$rut_ejecutivo,
             )); 
           }
           
           public function actionDetalleEmpresa($id){
                
            $this->layout='//layouts/mainReporteBoss';
            
            $sql="SELECT * FROM ficha_visita WHERE id = '$id'";
            $detalleEmpresa=Yii::app()->db->createCommand($sql)->queryAll();
            
            $this->render('detalleEmpresa',array(
                'detalleEmpresa'=>$detalleEmpresa)); 
           } 
           
           
           public function actionContarVisitasSup(){
               
            $user=Yii::app()->user->getState('rut');   
            $this->layout='//layouts/mainReporteBoss';
            
            $buscar=new Buscar();
            $x=new FichaVisita();
            $tabla=array();
            date_default_timezone_set('UTC');
            $year=date("Y");
            //$mes=$_GET['mes'];
               
//               $oriente=array('Puente Alto'=>'Puente Alto','La Florida'=>'La Florida'
//                        ,'La Reina'=>'La Reina','Las Condes'=>'Las Condes'
//                        ,'Lo Barnechea'=>'Lo Barnechea','Peñalolén'=>'Peñalolén','Providencia'=>'Providencia','Vitacura'=>'Vitacura');
//            
//               $norte=array('Cerro Navia'=>'Cerro Navia','Conchalí'=>'Conchalí','Estación Central'=>'Estación Central'
//                        ,'Huechuraba'=>'Huechuraba','Independencia'=>'Independencia'
//                        ,'Lo Prado'=>'Lo Prado','Pudahuel'=>'Pudahuel','Quilicura'=>'Quilicura','Quinta Normal'=>'Quinta Normal','Recoleta'=>'Recoleta'
//                        ,'Renca'=>'Renca','Santiago'=>'Santiago');
//               
//               $sur=array('San Bernardo'=>'San Bernardo','Cerrillos'=>'Cerrillos','El Bosque'=>'El Bosque'
//                        ,'La Cisterna'=>'La Cisterna','La Granja'=>'La Granja','La Pintana'=>'La Pintana'
//                        ,'Lo Espejo'=>'Lo Espejo','Macul'=>'Macul','Maipú'=>'Maipú'
//                        ,'Ñuñoa'=>'Ñuñoa','Pedro Aguirre Cerda'=>'Pedro Aguirre Cerda','San Miguel'=>'San Miguel'
//                        ,'San Joaquín'=>'San Joaquín','San Ramón'=>'San Ramón','Padre Hurtado'=>'Padre Hurtado');
               
                           $sql="select rut from usuario where tipo='ejecutivo' and estado='Activo' and rut_padre='$user'";
                           $ej=Yii::app()->db->createCommand($sql)->queryAll();
                           
                            foreach($ej as $data2){
                                $a2[]=$data2['rut'];
                            }
                           
                           foreach($a2 as $ejecutivo){
                               
                           $list1= $x->getNombreJV($ejecutivo);
                           $list2=$x->getNombreSup($ejecutivo);
                           $sql3="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$ejecutivo'";
                           $sql4="select count(rut_empresa) as empresas from ficha_visita where rut_eje='$ejecutivo'";
                           $list3=Yii::app()->db->createCommand($sql3)->queryScalar();
                           $list4=Yii::app()->db->createCommand($sql4)->queryScalar();
                           
                           $verEjecutivo=CHtml::link($list3,array('detalleEjecutivo','rut_ejecutivo'=>$ejecutivo),array('style'=>'color:#0101DF;'));
                           $tabla[]="<td></td><td>$list1</td><td>$list2</td><td>$verEjecutivo</td><td>$list4</td>";
                        }
                     $this->render('reporte',array(
                        'tabla'=>$tabla,'buscar'=>$buscar));
               
           }
           
           public function contarEjecutivos($rut_supervisor){
                    $sql="select count(rut) from usuario where tipo='ejecutivo' and estado='Activo' and rut_padre='$rut_supervisor'";
                    $numeroEjecutivos=Yii::app()->db->createCommand($sql)->queryScalar();
                    return $numeroEjecutivos;
           }
           public function contarEjecutivosPorJV($rut_jv){
                $suma=0;
                $sql="select rut from usuario where rut_padre='$rut_jv' and estado='Activo'";
                $rutSupervisor=Yii::app()->db->createCommand($sql)->queryAll();
            
            foreach($rutSupervisor as $data2){
                $a2[]=$data2['rut'];
            }
             foreach($a2 as $rutSup){
                $sql1="select count(rut) from usuario where rut_padre='$rutSup' and estado='Activo'";
                $rutEjecutivos=Yii::app()->db->createCommand($sql1)->queryScalar();
                $suma+=$rutEjecutivos;
             }
            return $suma;
           }
           
           
           public function contarSupervisores($rut_jefeVenta){
                    $sql="select count(rut) from usuario where tipo='supervisor' and estado='Activo' and rut_padre='$rut_jefeVenta'";
                    $numeroSupervisores=Yii::app()->db->createCommand($sql)->queryScalar();
                    return $numeroSupervisores;
           }
           
           
           public function actionReporteVisitas(){
               $this->layout='//layouts/mainReporteBoss';
               $rutFco="8820971-0";
               $rutEmanuel="14198477-2";
               $rutAdolfo="16666225-7";        
               $buscar=new Buscar();
            
             if(isset($_POST['Buscar']['op'])&&isset($_POST['Buscar']['rut'])){
                 
                 $fechaDiaria=$_POST['Buscar']['rut'];
                 $metaDiaria=$_POST['Buscar']['op'];
                 $mes=substr("$fechaDiaria", 5, -3);
                 $reunionDiariaJV1=0;
                 $reunionMensualJV1=0;
                 $reunionDiariaJV2=0;
                 $reunionMensualJV2=0;
                 $reunionDiariaJV3=0;
                 $reunionMensualJV3=0;
               
                    
               //FRANCISCO
               $sql1="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rutFco'";
               $nombreJV1=Yii::app()->db->createCommand($sql1)->queryScalar();
               $metaDiariaJV1=($this->contarEjecutivosPorJV($rutFco)*$metaDiaria);
               $metaMensualJV1=($this->contarEjecutivosPorJV($rutFco)*$metaDiaria)*21;
               //datos supervisores
               $sql="select rut from usuario where rut_padre='$rutFco' and estado='Activo'";
               $rutSupervisor=Yii::app()->db->createCommand($sql)->queryAll();
               foreach($rutSupervisor as $data1){
               $a1[]=$data1['rut'];
               }
               foreach($a1 as $superv){
                $sqls1="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$superv'";
                $nombreSup1=Yii::app()->db->createCommand($sqls1)->queryScalar();
                $sqls11="select count(rut_empresa) as empresas from ficha_visita where rut_sup='$superv' and fecha_visita='$fechaDiaria'";
                $reunionDiariaSup1=Yii::app()->db->createCommand($sqls11)->queryScalar();
                (int)$metaDiariaSup1=($this->contarEjecutivos($superv)*$metaDiaria);
                $sqls111="select count(rut_empresa) as empresas from ficha_visita where rut_sup='$superv' and MONTH(fecha_visita)='$mes'";
                $reunionMensualSup1=Yii::app()->db->createCommand($sqls111)->queryScalar();
                $totalMetaMensualSup1=$metaDiariaSup1*21;
                
                $reunionDiariaJV1=$reunionDiariaJV1+$reunionDiariaSup1;
                $reunionMensualJV1=$reunionMensualJV1+$reunionMensualSup1;
                
                $tabla1[]="<td>$nombreSup1</td><td>$reunionDiariaSup1</td><td>$metaDiariaSup1</td><td>$reunionMensualSup1</td><td>$totalMetaMensualSup1</td>";  
               }
               //Emanuel
               $sql12="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rutEmanuel'";
               $nombreJV2=Yii::app()->db->createCommand($sql12)->queryScalar();
               $metaDiariaJV2=($this->contarEjecutivosPorJV($rutEmanuel)*$metaDiaria);
               $metaMensualJV2=($this->contarEjecutivosPorJV($rutEmanuel)*$metaDiaria)*21;
               //datos supervisores
               $sql2="select rut from usuario where rut_padre='$rutEmanuel' and estado='Activo'";
               $rutSupervisor2=Yii::app()->db->createCommand($sql2)->queryAll();
               foreach($rutSupervisor2 as $data2){
               $a2[]=$data2['rut'];
               }
               foreach($a2 as $superv2){
                $sqls12="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$superv2'";
                $nombreSup12=Yii::app()->db->createCommand($sqls12)->queryScalar();
                $sqls112="select count(rut_empresa) as empresas from ficha_visita where rut_sup='$superv2' and fecha_visita='$fechaDiaria'";
                $reunionDiariaSup12=Yii::app()->db->createCommand($sqls112)->queryScalar();
                (int)$metaDiariaSup12=($this->contarEjecutivos($superv2)*$metaDiaria);
                $sqls1112="select count(rut_empresa) as empresas from ficha_visita where rut_sup='$superv2' and MONTH(fecha_visita)='$mes'";
                $reunionMensualSup12=Yii::app()->db->createCommand($sqls1112)->queryScalar();
                $totalMetaMensualSup12=$metaDiariaSup12*21;
                
                $reunionDiariaJV2=$reunionDiariaJV2+$reunionDiariaSup12;
                $reunionMensualJV2=$reunionMensualJV2+$reunionMensualSup12;
                
                $tabla2[]="<td>$nombreSup12</td><td>$reunionDiariaSup12</td><td>$metaDiariaSup12</td><td>$reunionMensualSup12</td><td>$totalMetaMensualSup12</td>";  
               }
               //Adolfo
               $sql13="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$rutAdolfo'";
               $nombreJV3=Yii::app()->db->createCommand($sql13)->queryScalar();
               $metaDiariaJV3=($this->contarEjecutivosPorJV($rutAdolfo)*$metaDiaria);
               $metaMensualJV3=($this->contarEjecutivosPorJV($rutAdolfo)*$metaDiaria)*21;
               //datos supervisores
               $sql3="select rut from usuario where rut_padre='$rutAdolfo' and estado='Activo'";
               $rutSupervisor3=Yii::app()->db->createCommand($sql3)->queryAll();
               foreach($rutSupervisor3 as $data3){
               $a3[]=$data3['rut'];
               }
               foreach($a3 as $superv3){
                $sqls13="select CONCAT(nombre,' ', apellido) as names from usuario where rut='$superv3'";
                $nombreSup3=Yii::app()->db->createCommand($sqls13)->queryScalar();
                $sqls113="select count(rut_empresa) as empresas from ficha_visita where rut_sup='$superv3' and fecha_visita='$fechaDiaria'";
                $reunionDiariaSup3=Yii::app()->db->createCommand($sqls113)->queryScalar();
                (int)$metaDiariaSup3=($this->contarEjecutivos($superv3)*$metaDiaria);
                $sqls1113="select count(rut_empresa) as empresas from ficha_visita where rut_sup='$superv3' and MONTH(fecha_visita)='$mes'";
                $reunionMensualSup3=Yii::app()->db->createCommand($sqls1113)->queryScalar();
                $totalMetaMensualSup3=$metaDiariaSup3*21;
                
                $reunionDiariaJV3=$reunionDiariaJV3+$reunionDiariaSup3;
                $reunionMensualJV3=$reunionMensualJV3+$reunionMensualSup3;
                
                $tabla3[]="<td>$nombreSup3</td><td>$reunionDiariaSup3</td><td>$metaDiariaSup3</td><td>$reunionMensualSup3</td><td>$totalMetaMensualSup3</td>";  
               }
                 
                         $this->render('resumenVisitas',array(
                        'buscar'=>$buscar,
                                //Francisco   
                        'nombreJV1'=>$nombreJV1,
                        'reunionDiariaJV1'=>$reunionDiariaJV1,
                        'metaDiariaJV1'=>$metaDiariaJV1,
                        'reunionMensualJV1'=>$reunionMensualJV1,
                        'metaMensualJV1'=>$metaMensualJV1,
                        'tabla1'=>$tabla1,
                                //Emanuel   
                        'nombreJV2'=>$nombreJV2,
                        'reunionDiariaJV2'=>$reunionDiariaJV2,
                        'metaDiariaJV2'=>$metaDiariaJV2,
                        'reunionMensualJV2'=>$reunionMensualJV2,
                        'metaMensualJV2'=>$metaMensualJV2,
                        'tabla2'=>$tabla2,
                                //Adolfo   
                        'nombreJV3'=>$nombreJV3,
                        'reunionDiariaJV3'=>$reunionDiariaJV3,
                        'metaDiariaJV3'=>$metaDiariaJV3,
                        'reunionMensualJV3'=>$reunionMensualJV3,
                        'metaMensualJV3'=>$metaMensualJV3,
                        'tabla3'=>$tabla3,
                        'metaDiaria'=>$metaDiaria,
                        'fechaDiaria'=>$fechaDiaria
                         ));
                 
             }else{
               $this->render('resumenVisitas',array('buscar'=>$buscar)); 
             }
               
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
        
        public function actionAlertasJSON(){
              $tipo=Yii::app()->user->getState('tipo');
            $rut=Yii::app()->user->getState('rut');
            $where="";
            if($tipo=='supervisor'){ $where= "and rut_sup='$rut'"; }
            elseif($tipo=='jefe de venta'){ $where= "and rut_jv='$rut'";  }
            
            date_default_timezone_set("America/Santiago");
            $fechaHoy=date("Y-m-d");
            
            $sql="select nombre_jv,nombre_sup,nombre_eje,nombre_empresa,rut_empresa,visita,date(fech_pos_cierre) as date from ficha_visita
           ";
            $id=Yii::app()->db->createCommand($sql)->queryAll();
            
            $sql2="select count(id) from ficha_visita
           ";
            $nTotal=Yii::app()->db->createCommand($sql2)->queryAll();
            
             
             foreach($id as $row) {         
                $aaData[] = array(                  
                $row['nombre_jv'],
                $row['nombre_sup'], 
                $row['nombre_eje'],
                $row['nombre_empresa'],
                $row['rut_empresa'],
                $row['visita'],
                $row['date'] 
                );             
            }
            $aa = array(
            //'sEcho' => $_POST['sEcho'],
            'iTotalRecords' => $nTotal,
            'iTotalDisplayRecords' => $nTotal,
            'aaData' => $aaData);
            //echo CJSON::encode($res);
             $this->renderJSON($aa);
            
        }
        
        
        public function actionAlertasCierres(){
//            $tipo=Yii::app()->user->getState('tipo');
//            $rut=Yii::app()->user->getState('rut');
//            $where="";
//            if($tipo=='supervisor'){ $where= "and rut_sup='$rut'"; }
//            elseif($tipo=='jefe de venta'){ $where= "and rut_jv='$rut'";  }
//           
//            
//            date_default_timezone_set("America/Santiago");
//            $fechaHoy=date("Y-m-d");
//            
//            $sql="select id,nombre_eje from ficha_visita where fech_pos_cierre != '0000-00-00' $where";
//            $id=Yii::app()->db->createCommand($sql)->queryAll();
            
//            $a=array();
//            $regAlertas=array();
//            foreach($id as $data){
//             $a[]=$data['id'];   
//            }
//            
//            foreach($a as $ide){
//                
//              //verificando si ya existe en la tabla solicitud contrato, si existe no se agrega al array a[]
//              $sql911="select rut_empresa from ficha_visita where id='$ide'";
//              $rut_empresa2=Yii::app()->db->createCommand($sql911)->queryScalar();
//              
//              $sql912="select id from solicitud_contrato where rut_empresa='$rut_empresa2'";
//              $existe=Yii::app()->db->createCommand($sql912)->queryScalar();
//              
//              if($existe==false){
//                
//              $sql1="select rut_empresa from solicitud_contrato where id='$ide'";
//              $nombre_jv=Yii::app()->db->createCommand($sql1)->queryScalar();
//              
//              $sql1="select nombre_jv from ficha_visita where id='$ide'";
//              $nombre_jv=Yii::app()->db->createCommand($sql1)->queryScalar();
//              
//              $sql2="select nombre_sup from ficha_visita where id='$ide'";
//              $nombre_sup=Yii::app()->db->createCommand($sql2)->queryScalar();
//                
//              $sql3="select nombre_eje from ficha_visita where id='$ide'";
//              $nombre_eje=Yii::app()->db->createCommand($sql3)->queryScalar();
//              
//              $sql4="select nombre_empresa from ficha_visita where id='$ide'";
//              $nombre_empresa=Yii::app()->db->createCommand($sql4)->queryScalar();
//              
//              $sql5="select rut_empresa from ficha_visita where id='$ide'";
//              $rut_empresa=Yii::app()->db->createCommand($sql5)->queryScalar();
//              
//              $sql6="select visita from ficha_visita where id='$ide'";
//              $visita=Yii::app()->db->createCommand($sql6)->queryScalar();
//              
//              $sql7="select date(fech_pos_cierre) from ficha_visita where id='$ide'";
//              $fech_pos_cierre=Yii::app()->db->createCommand($sql7)->queryScalar();
//              
//              
//              $sql8="select DATEDIFF('$fech_pos_cierre','$fechaHoy') as dias from ficha_visita";
//              $dias=Yii::app()->db->createCommand($sql8)->queryScalar();
//              
//              if($dias<0){$dias="Vencida";}elseif($fech_pos_cierre=='0000-00-00'){ $dias="N/A";}elseif($dias==0){$dias="<b style='color:red;'>Hoy</b>";}else{$dias=$dias." días";}
//            
//             // $verEmpresa=CHtml::link($nombre_empresa,array('detalleEmpresa','id'=>$ide),array('style'=>'color:#0101DF;'));
//
//              $regAlertas[]=array('nombre_jv'=>$nombre_jv,'nombre_sup'=>$nombre_sup,'nombre_eje'=>$nombre_eje,'nombre_empresa'=>$nombre_empresa,'rut_empresa'=>$rut_empresa,'visita'=>$visita,'fecha_cierre'=>$fech_pos_cierre,'dias'=>$dias);
//              
//             // $regAlertas[]="<td></td><td>$nombre_jv</td><td>$nombre_sup</td><td>$nombre_eje</td><td>$verEmpresa</td><td>$rut_empresa</td><td>$visita</td><td>$fech_pos_cierre</td><td>$dias</td>";  
//              
//              }
//            }
            
            //$this->renderJSON($id);
            $this->render('fechasCierre');
            
        }
        
        
protected function renderJSON($data)
{
    header('Content-type: application/json');
    echo CJSON::encode($data);

    foreach (Yii::app()->log->routes as $route) {
        if($route instanceof CWebLogRoute) {
            $route->enabled = false; // disable any weblogroutes
        }
    }
    Yii::app()->end();
}
        
        
        
   }
        
        
        

