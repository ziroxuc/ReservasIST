<?php

class SenaleticasController extends Controller
{
    
    
    public $layout='//layouts/column2';
    
public function accessRules()
	{
		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','view','getSenaleticasJSON','viewAgregarDatos','delete'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="administrador"',
                               
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','view','getSenaleticasJSON','viewAgregarDatos','delete'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="gerente"',
                               
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $this->layout='//layouts/main';
            $model=new LoginForm;
        
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index',array('model'=>$model));
	}
        
        protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitud-contrato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		} 
	}
        
        public function actionAdmin(){
            
             $model=new Senaleticas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Senaleticas']))
			$model->attributes=$_GET['Senaleticas'];

		$this->render('admin',array(
			'model'=>$model,
		));
        }
        
        public function actionView($id)
	{
           
            $this->render('view',array(
			'model'=>$this->loadModel($id),
                      
		));
	}
        
        
        public function loadModel($id)
	{
		$model=  Senaleticas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function actionViewAgregarDatos($id){
            $model=$this->loadModel($id);
            
            if(isset($_POST['Senaleticas']))
		{
                    $model->attributes=$_POST['Senaleticas'];
                    $model->nombre_recibe = $_POST['Senaleticas']['nombre_recibe'];
                    $model->cargo = $_POST['Senaleticas']['cargo'];
                    $model->telefono = $_POST['Senaleticas']['telefono'];
                    $model->fecha_recepcion = $_POST['Senaleticas']['fecha_recepcion'];
                    $model->nombre_pago = $_POST['Senaleticas']['nombre_pago'];
                    $model->telefono_pago = $_POST['Senaleticas']['telefono_pago'];
                    $model->estado = 'Terminado';
                    
                        if($model->save()){
                        $this->redirect(array('view','id'=>$model->id));
                        }
		}
            
            $this->render('agregarDatos',array(
			'model'=>$model,
		)); 
            
        }
        
        public function actionCreate(){
                $model=new Senaleticas();
                $model2=new SolicitudContrato();
                
		// Uncomment the following line if AJAX validation is needed
                 $this->performAjaxValidation($model);

		if(isset($_POST['SolicitudContrato']))
		{
                    //rescatmos rut de la empresa que se guardara

                        $model->rut_eje = $_POST['SolicitudContrato']['rut_ejecutivo'];
                        $model->rut_sup = $_POST['SolicitudContrato']['rut_sup'];
                        $model->rut_jv = $_POST['SolicitudContrato']['rut_jv'];
                        $model->nombre_eje = $this->agregaNombreEjecutivo($_POST['SolicitudContrato']['rut_ejecutivo']);
                        $model->nombre_sup = $this->agregaNombreSupervisor($_POST['SolicitudContrato']['rut_sup']);
                        $model->nombre_jv = $this->agregaNombreJefeVenta($_POST['SolicitudContrato']['rut_jv']);
                    
                        $model->fecha_entrega = new CDbExpression('NOW()');
                        $model->usuario_web =  Yii::app()->user->getState("nombre")." ".Yii::app()->user->getState("apellido");
                        $model->estado = "Pendiente";
                        
                        $model->nombre_empresa = $_POST['SolicitudContrato']['nombre_empresa'];
                        $model->rut_empresa = $_POST['SolicitudContrato']['rut_empresa'];
                                
			if($model->save()){
                         $this->render('view',array(
                            'senaleticaOK'=>"1",
                            'model'=>$model,
                            'model2'=>$model2 
                        ));   
                        }
		
                }
            
        }
        
        public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
        
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
        
        
        
        public function actionGetSenaleticasJSON(){
           $sql="SELECT nombre_jv, nombre_sup, nombre_eje, nombre_empresa, DATE_FORMAT(fecha_entrega,'%d-%m-%Y %H:%i:%s') as fecha_entrega,usuario_web, estado FROM senaleticas";
           $data =  Yii::app()->db->createCommand($sql)->queryAll(); 
           
             $sql2="select count(id) from senaleticas";
            $nTotal=Yii::app()->db->createCommand($sql2)->queryAll();
            
             foreach($data as $row) {         
                $aaData[] = array(
                   
                $row['nombre_jv'],
                $row['nombre_sup'], 
                $row['nombre_eje'],
                $row['nombre_empresa'],
                $row['fecha_entrega'],
                $row['usuario_web'],
                $row['estado'],           
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