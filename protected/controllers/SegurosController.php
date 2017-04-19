<?php

class SegurosController extends Controller
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
				'actions'=>array('create','update','delete','admin','view','supervisorPorJV','ejecutivoPorSup','createDerivado','SegurosExcel'),
                                'expression'=>'Usuario::model()->findByPk(Yii::app()->user->getId())->tipo=="administrador"',   
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
        public function calculaPrimaMensual($plan,$odontoIn,$odontoF,$IntQuiru,$rentaMen){
            
            $planUF=0;$odontoInUF=0;$odontoFUF=0;$IntQuiruUF=0;$rentaMenUF=0;       
            
            if($plan==1){$planUF=0.2140;}elseif($plan==2){$planUF=0.2560;}elseif($plan==3){$planUF=0.2990;}
            
            if($odontoIn==0){$odontoInUF=0;}elseif($odontoIn==1){$odontoInUF=0.149;}
            
            if($odontoF==0){$odontoFUF=0;}elseif($odontoF==1){$odontoFUF=0.295;}
            
            if($IntQuiru==0){$IntQuiruUF=0;}elseif($IntQuiru==1){$IntQuiruUF=0.097;}elseif($IntQuiru==2){$IntQuiruUF=0.181;}elseif($IntQuiru==3){$IntQuiruUF=0.278;}
            
            if($rentaMen==0){$rentaMenUF=0;}elseif($rentaMen==1){$rentaMenUF=0.067;}elseif($rentaMen==2){$rentaMenUF=0.099;}elseif($rentaMen==3){$rentaMenUF=0.131;}
        
            
            $primaMensual=$planUF+$odontoInUF+$odontoFUF+$IntQuiruUF+$rentaMenUF;
            return $primaMensual;
           }
           
           public function getNombreBanco($numBanco){
               
               $nombreBanco="";
               if($numBanco==1){
                   $nombreBanco='BCI';
               }elseif($numBanco==2){
                   $nombreBanco='CHILE';
               }elseif($numBanco==3){
                   $nombreBanco='CORPBANCA';
               }elseif($numBanco==4){
                   $nombreBanco='SUDAMERICANO';
               }elseif($numBanco==5){
                   $nombreBanco='SANTIAGO';
               }elseif($numBanco==6){
                   $nombreBanco='CITIBANK';
               }elseif($numBanco==7){
                   $nombreBanco='DESARROLLO';
               }elseif($numBanco==8){
                   $nombreBanco='BHIF';
               }elseif($numBanco==9){
                   $nombreBanco='BICE';
               }elseif($numBanco==10){
                   $nombreBanco='EDWARDS';
               }elseif($numBanco==11){
                   $nombreBanco='SANTANDER';
               }elseif($numBanco==12){
                   $nombreBanco='DEL ESTADO';
               }elseif($numBanco==13){
                   $nombreBanco='ITAU';
               }elseif($numBanco==14){
                   $nombreBanco='SECURITY';
               }elseif($numBanco==15){
                   $nombreBanco='FALABELLA';
               }
               return $nombreBanco;
           }
           
           
	public function actionCreate()
	{
		$model=new Seguros;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Seguros']))
		{
                    $model->attributes=$_POST['Seguros'];
                    $model->prima_mensual_uf=$this->calculaPrimaMensual($_POST['Seguros']['plan'],$_POST['Seguros']['odonto_individual'],$_POST['Seguros']['odonto_familiar'],$_POST['Seguros']['interven_quirurgicas'],$_POST['Seguros']['renta_mensual']);
                    $model->nombre_banco=$this->getNombreBanco($_POST['Seguros']['banco']);
                    
                    //Separa rut
                    $rutSeparado = explode("-", trim($_POST['Seguros']['rut']));
                    $numero_rut= $rutSeparado[0]; // numero
                    $dv_rut= $rutSeparado[1]; // dv
                    
                    $model->rut=$numero_rut;
                    $model->digito=$dv_rut;
                    
                    //Separa rut empresa
                    $rutSeparado_emp = explode("-", trim($_POST['Seguros']['rut_empresa']));
                    $numero_rut_emp= $rutSeparado_emp[0]; // numero
                    $dv_rut_emp= $rutSeparado_emp[1]; // dv
                    
                    $model->rut_empresa=$numero_rut_emp;
                    $model->digito_empresa=$dv_rut_emp;
                    
                    $model->producto=207;
                    
                  
                    
                    $model->nombre_ejecutivo=$this->agregaNombreEjecutivo($_POST['Seguros']['rut_ejecutivo']);
                    $model->nombre_sup=$this->agregaNombreSupervisor($_POST['Seguros']['rut_sup']);
                    $model->nombre_jv=$this->agregaNombreJefeVenta($_POST['Seguros']['rut_jv']);
                    
                    if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        public function actionCreateDerivado()
	{
		$model=new Seguros;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Seguros']))
		{
                    $model->attributes=$_POST['Seguros'];
                    //$model->prima_mensual_uf=$this->calculaPrimaMensual($_POST['Seguros']['plan'],$_POST['Seguros']['odonto_individual'],$_POST['Seguros']['odonto_familiar'],$_POST['Seguros']['interven_quirurgicas'],$_POST['Seguros']['renta_mensual']);
                    //$model->nombre_banco=$this->getNombreBanco($_POST['Seguros']['banco']);
                    
                    //Separa rut
//                    $rutSeparado = explode("-", trim($_POST['Seguros']['rut']));
//                    $numero_rut= $rutSeparado[0]; // numero
//                    $dv_rut= $rutSeparado[1]; // dv
//                    
//                    $model->rut=$numero_rut;
//                    $model->digito=$dv_rut;
                    
                    //Separa rut empresa
                    $rutSeparado_emp = explode("-", trim($_POST['Seguros']['rut_empresa']));
                    $numero_rut_emp= $rutSeparado_emp[0]; // numero
                    $dv_rut_emp= $rutSeparado_emp[1]; // dv
                    
                    $model->rut_empresa=$numero_rut_emp;
                    $model->digito_empresa=$dv_rut_emp;
                    
                    //$model->producto=207;
                    
                    $model->nombre_ejecutivo=$this->agregaNombreEjecutivo($_POST['Seguros']['rut_ejecutivo']);
                    $model->nombre_sup=$this->agregaNombreSupervisor($_POST['Seguros']['rut_sup']);
                    $model->nombre_jv=$this->agregaNombreJefeVenta($_POST['Seguros']['rut_jv']);
                    
                    if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('createDerivado',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Seguros']))
		{
		    $model->attributes=$_POST['Seguros'];
                    $model->prima_mensual_uf=$this->calculaPrimaMensual($_POST['Seguros']['plan'],$_POST['Seguros']['odonto_individual'],$_POST['Seguros']['odonto_familiar'],$_POST['Seguros']['interven_quirurgicas'],$_POST['Seguros']['renta_mensual']);
                    $model->nombre_banco=$this->getNombreBanco($_POST['Seguros']['banco']);
                    
                    //Separa rut
                    $rutSeparado = explode("-", trim($_POST['Seguros']['rut']));
                    $numero_rut= $rutSeparado[0]; // numero
                    $dv_rut= $rutSeparado[1]; // dv
                    
                    $model->rut=$numero_rut;
                    $model->digito=$dv_rut;
                    
                    //Separa rut empresa
                    $rutSeparado_emp = explode("-", trim($_POST['Seguros']['rut_empresa']));
                    $numero_rut_emp= $rutSeparado_emp[0]; // numero
                    $dv_rut_emp= $rutSeparado_emp[1]; // dv
                    
                    $model->rut_empresa=$numero_rut_emp;
                    $model->digito_empresa=$dv_rut_emp;
                   
                    $model->producto=207;
                    $model->nombre_ejecutivo=$this->agregaNombreEjecutivo($_POST['Seguros']['rut_ejecutivo']);
                    $model->nombre_sup=$this->agregaNombreSupervisor($_POST['Seguros']['rut_sup']);
                    $model->nombre_jv=$this->agregaNombreJefeVenta($_POST['Seguros']['rut_jv']);
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
		$dataProvider=new CActiveDataProvider('Seguros');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Seguros('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seguros']))
			$model->attributes=$_GET['Seguros'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Seguros the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Seguros::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Seguros $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seguros-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
          public function actionSupervisorPorJV()
        {
            $tipo = $_POST['Seguros']['rut_jv'];
            
            $list= Usuario::model()->findAll("rut_padre=?",array($tipo));
            echo CHtml::tag('option', array('value' => ''), 'Seleccione un supervisor', true);
            
           foreach($list as $data){
               //echo "<option value=''selected='selected'>Seleccione</option>";
               echo "<option value=\"{$data->rut}\">{$data->nombre} {$data->apellido}</option>";
               
           }
        }
        
         public function actionEjecutivoPorSup()
        {
            $tipo = $_POST['Seguros']['rut_sup'];
            
            $list= Usuario::model()->findAll("rut_padre=?",array($tipo));
            echo CHtml::tag('option', array('value' => ''), 'Seleccione un ejecutivo', true);
           foreach($list as $data){
               //echo "<option value=''selected='selected'>Make a choice</option>";
               echo "<option value=\"{$data->rut}\">{$data->nombre} {$data->apellido}</option>";
               
           }
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
        
        	public function actionSegurosExcel()
	{
            //if( Yii::app()->user->getState("tipo")==="administrador"){
                date_default_timezone_set('UTC');
             $model= Seguros::model()->findAll();
             Yii::app()->request->sendFile('Polizas de seguros '.date("d-m-y").'.xls', $this->renderPartial('excel',array(
                 'model'=>$model,
             ),true));
	}
        
        
        
}
