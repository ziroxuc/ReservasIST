<?php

class SiteController extends Controller
{
    
    public $defaultAction = 'login';
    public $layout='//layouts/main2';
	/**
	 * Declares class-based actions.
	 */
    
    //public function filters()
//{
  //      return array(
             //   'accessControl', // perform access control for CRUD operations
      ////  );
//}
/**
 * Specifies the access control rules.
 * method is used by the 'accessControl' filter.
 * @return array access control rules
 */

       	public function accessRules()
{
        return array(
                array('allow', // allow authenticated user to perform 'index','view','create' and 'update' actions
                        'actions'=>array('index','view','create','update'),
                        'users'=>array('@'),
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions'=>array('admin','delete'),
                        'users'=>array('admin'),
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

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
                    $rutParse = str_replace('.', '', $_POST['LoginForm']['rut']);   
			$model->rut=$rutParse;
                        $model->password=$_POST['LoginForm']['password'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                               if(Yii::app()->user->getState("tipo")==='administrador'){
                                    
                                    $this->redirect(array('site/index'));
                                    
                                }else{
                                       $report=new RegistroReportes();
                                    if($report->addRegistroReporte("R")){
                                    $this->redirect(array('reporteBoss/index')); 
                                    }
                                }
				//$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
//                 if($model->validate() && $model->login()){
//                 $this->redirect(array('site/index'));    
	}
        
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
          public function actionSessionOff()
        {
                $this->render('sessionOff');
        }
        
}