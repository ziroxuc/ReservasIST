<?php

class UsuarioController extends Controller
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
				'actions'=>array('create','update','delete','jefesPorUsuario','admin','view','createExterno','dependencias','modificaDependencia'),
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
	public function actionCreate()
	{
		$model=new Usuario;
                $histoDependencia= new HistorialDependencias(); 
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
                        $model->estado='Activo';
                        $model->password=  sha1($model->password);
                        
                       
               $histoDependencia->rut=$_POST['Usuario']['rut'];
               $histoDependencia->nombre=$_POST['Usuario']['nombre']." ".$_POST['Usuario']['apellido'];
               $histoDependencia->tipo = $_POST['Usuario']['tipo'];
               $histoDependencia->estado = $_POST['Usuario']['estado'];
               $histoDependencia->fech_inicio_contr = $_POST['Usuario']['fecha_ingreso'];
               $histoDependencia->fech_termino_contr = $_POST['Usuario']['fecha_salida'];

               $histoDependencia->rut_depen_jv = $_POST['Usuario']['rut_padre'];
               $histoDependencia->dependencia_jv = $user->getNombreDependencia($_POST['HistorialDependencias']['dependencia_jv']);
               
               $histoDependencia->rut_depen_sup = $_POST['HistorialDependencias']['dependencia_sup'];
               $histoDependencia->dependencia_sup = $user->getNombreDependencia($_POST['HistorialDependencias']['dependencia_sup']);

               $histoDependencia->fech_inicio_depen = $_POST['HistorialDependencias']['fech_inicio_depen'];
               //$histoDependencia->fech_termino_depen = $_POST['HistorialDependencias']['fech_termino_depen'];

               $histoDependencia->usuario_web_modif = Yii::app()->user->getState('nombre')." ".Yii::app()->user->getState('apellido');
               $histoDependencia->fech_usuario_web_modif = new CDbExpression('NOW()');
               
               // la fecha inicio dependencia sera la fecha fin dependencia del registro anterior
               $this->actualizaDependencias($histoDependencia->rut, $_POST['HistorialDependencias']['fech_termino_depen']);
               
               //actualiza el campo rut_padre de la tabla usuarios dependiendo del tipo ejec o sup
               if($histoDependencia->tipo=='ejecutivo'){
                $this->actualizaRutPadre($histoDependencia->rut, $histoDependencia->rut_depen_sup);
               }else{
                $this->actualizaRutPadre($histoDependencia->rut, $histoDependencia->rut_depen_jv);  
               }       
			if($model->save())
				$this->redirect(array('view','id'=>$model->rut));
		}
		$this->render('create',array(
			'model'=>$model));
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
        public function cambiaJefeVenta($rutJV,$rutSup){
            
           $sql="update usuario set rut_padre='$rutJV' where rut='$rutSup'";
           $cambio=Yii::app()->db->createCommand($sql)->execute();  
        }
        
        public function getRutPadre($rutSup){
            
           $sql="select rut_padre from usuario where rut='$rutSup'";
           $rutPadre=Yii::app()->db->createCommand($sql)->queryScalar();  
           return $rutPadre;
        }
                
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
                $histoDependencia= new HistorialDependencias();
                $datos = new Datos();
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
                        $model->attributes=$_POST['Usuario'];
                        if(strlen($_POST['Usuario']['password'])>10){
                            $model->password=$model->password;
                        }else{
                            $model->password=  sha1($model->password);
                        }
                        if(isset($_POST['Datos']['rutJefeVenta'])&&$model->tipo==="ejecutivo"&&$_POST['Datos']['rutJefeVenta']!==""){
                         $this->cambiaJefeVenta($_POST['Datos']['rutJefeVenta'], $_POST['Usuario']['rut_padre']);  
                        }
                         
                        if(isset($_POST['Datos']['rutJefeVenta'])&&$model->tipo==="ejecutivo"&&$_POST['Datos']['rutJefeVenta']!==""){
                            
                         $this->getRutPadre($_POST['Usuario']['rut']);  
                        }
                        
                        if($model->save())
				$this->redirect(array('view','id'=>$model->rut));
		}
		$this->render('update',array(
			'model'=>$model,
                        'datos'=>$datos,
                        'dependencia'=>$histoDependencia
		));
	}
        public function actionModificaDependencia(){
            
            
            $histoDependencia= new HistorialDependencias();
            $user = new Usuario();
            
               $histoDependencia->rut=$_POST['Usuario']['rut'];
               $histoDependencia->nombre=$_POST['Usuario']['nombre']." ".$_POST['Usuario']['apellido'];
               $histoDependencia->tipo = $_POST['Usuario']['tipo'];
               $histoDependencia->estado = $_POST['Usuario']['estado'];
               $histoDependencia->fech_inicio_contr = $_POST['Usuario']['fecha_ingreso'];
               $histoDependencia->fech_termino_contr = $_POST['Usuario']['fecha_salida'];

               $histoDependencia->rut_depen_jv = $_POST['HistorialDependencias']['dependencia_jv'];
               $histoDependencia->dependencia_jv = $user->getNombreDependencia($_POST['HistorialDependencias']['dependencia_jv']);
               
               $histoDependencia->rut_depen_sup = $_POST['HistorialDependencias']['dependencia_sup'];
               $histoDependencia->dependencia_sup = $user->getNombreDependencia($_POST['HistorialDependencias']['dependencia_sup']);

               $histoDependencia->fech_inicio_depen = $_POST['HistorialDependencias']['fech_inicio_depen'];
               //$histoDependencia->fech_termino_depen = $_POST['HistorialDependencias']['fech_termino_depen'];

               $histoDependencia->usuario_web_modif = Yii::app()->user->getState('nombre')." ".Yii::app()->user->getState('apellido');
               $histoDependencia->fech_usuario_web_modif = new CDbExpression('NOW()');
               
               // la fecha inicio dependencia sera la fecha fin dependencia del registro anterior
               $this->actualizaDependencias($histoDependencia->rut, $_POST['HistorialDependencias']['fech_termino_depen']);
               
               //actualiza el campo rut_padre de la tabla usuarios dependiendo del tipo ejec o sup
               if($histoDependencia->tipo=='ejecutivo'){
                $this->actualizaRutPadre($histoDependencia->rut, $histoDependencia->rut_depen_sup);
               }else{
                $this->actualizaRutPadre($histoDependencia->rut, $histoDependencia->rut_depen_jv);  
               }
               
               if( $histoDependencia->save())
				$this->redirect(array('view','id'=>$histoDependencia->rut));
               
           
        }
        
          public function actualizaRutPadre($rut,$rutPadre){
            
                $sql="update usuario set rut_padre = '$rutPadre' "
                        . "where rut = '$rut'";
                $query = Yii::app()->db->createCommand($sql)->execute();
                if($query>0){
                 return true;   
                }else{
                 return false;   
                }
            
        }
        
        
        //actualiza dependencias con el id = a rut del sujeto
        public function actualizaDependencias($rut,$fecha_fin_depen){
            
                $sql1="select max(id) from historial_dependencias where rut = '$rut'";
                $id = Yii::app()->db->createCommand($sql1)->queryScalar();
            
                $sql="update historial_dependencias set fech_termino_depen = '$fecha_fin_depen' "
                        . "where id = $id";
                $query = Yii::app()->db->createCommand($sql)->execute();
                if($query>0){
                 return true;   
                }else{
                 return false;   
                }
            
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
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            if(isset($_GET['excel'])){
                $usuario= Usuario::model()->findAll();
                date_default_timezone_set('UTC');
                Yii::app()->request->sendFile('Dotacion '.date("d-m-Y").'.xls', $this->renderPartial('excelDotacion',array(
                'usuario'=>$usuario,
             ),true)); 
                
            }
                $model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model
		));
                
	}
        public function actionDependencias()
	{
                $buscar=new Buscar();
                if(isset($_GET['Buscar']['rut'])||isset($_GET['rutF'])){
                     
                    if(isset($_GET['Buscar']['rut'])){
                        $rut=$_GET['Buscar']['rut'];
                        $rutF=str_replace(".","",$rut);
                    }elseif(isset($_GET['rutF'])){
                        $rut=$_GET['rutF'];
                        $rutF=str_replace(".","",$rut);
                    }
                   
		//$dependencias= HistorialDependencias::model()->find('rut=?', array($rut));
                $sql="select id,nombre,rut,tipo,estado,DATE_FORMAT(fech_inicio_contr, '%d-%m-%Y') as fech_inicio_contr ,"
                        . "DATE_FORMAT(fech_termino_contr, '%d-%m-%Y') as fech_termino_contr,DATE_FORMAT(fech_inicio_depen, '%d-%m-%Y') as fech_inicio_depen,"
                        . "DATE_FORMAT(fech_termino_depen, '%d-%m-%Y') as fech_termino_depen,dependencia_jv,dependencia_sup,usuario_web_modif,DATE_FORMAT(fech_usuario_web_modif, '%d-%m-%Y') as fech_usuario_web_modif"
                        . " from historial_dependencias where rut='$rutF' order by id desc";
                $dependencias = Yii::app()->db->createCommand($sql)->queryAll();
                
                if(isset($_GET['excel'])){
                    Yii::app()->request->sendFile('Dependencias.xls', $this->renderPartial('excel',array(
                    'dependencias'=>$dependencias,
                    ),true));
                 }
                
                $this->render('dependencias',array(
                    'dependencias'=>$dependencias,
                    'buscar'=>$buscar,
                    'rutF'=>$rutF));
                }else{
                $this->render('dependencias',array(
                    'buscar'=>$buscar));
                }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
            $model=Usuario::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'La página no existe.');
            return $model;
	}
        
        public function loadModelDos($id)
	{
            $sql1="select rut_padre from usuario where rut='$id'";
            $rut_sup=Yii::app()->db->createCommand($sql1)->queryScalar();
            
            $sql="select rut_padre from usuario where rut='$rut_sup'";
            $rut_jv=Yii::app()->db->createCommand($sql)->queryScalar();
            
		$datos=Usuario::model()->findByPk($rut_jv);
		if($datos===null)
			throw new CHttpException(404,'La página no existe.');
		return $datos;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Usuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
       public function actionJefesPorUsuario()
        {
            $tipo = $_POST['Usuario']['tipo'];
            $busca_jefe=null;
            
            if($tipo === "ejecutivo"){
                
                $busca_jefe="supervisor";
                
            }elseif ($tipo === "supervisor") {
                
                $busca_jefe="jefe de venta";
        }
            
            $list= Usuario::model()->findAll("tipo=? and estado='Activo'",array($busca_jefe));
            
           foreach($list as $data){
               echo "<option value=\"{$data->rut}\">{$data->nombre} {$data->apellido}</option>";
               
           }
        }
        
}
