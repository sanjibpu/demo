<?php

class SaleslistController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction='admin';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','csvImport','view'),
				'users'=>array('*'),				
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),				
				'expression'=>'isset(Yii::app()->user->userType) && Yii::app()->user->userType==Users::IS_ADMIN',

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
		$msg='';
		$model=new Saleslist;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Saleslist']))
		{
			$model->attributes=$_POST['Saleslist'];
			if($model->save()){
				$msg = "<div class='alert alert-success  fade in'><i data-dismiss='alert' class='icon-remove close'></i>Add Successfully</div>";
				$model=new Saleslist;
			}
		}

		$this->render('_form',array(
			'model'=>$model,
			'msg'=>$msg,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$msg='';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
	     $this->performAjaxValidation($model);

		if(isset($_POST['Saleslist']))
		{
			$model->attributes=$_POST['Saleslist'];
			if($model->save())
			$msg = "<div class='alert alert-success  fade in'><i data-dismiss='alert' class='icon-remove close'></i>Update Successfully</div>";
		}

		$this->render('_form',array(
			'model'=>$model,
			'msg'=>$msg,
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
		$dataProvider=new CActiveDataProvider('Saleslist');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Saleslist('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Saleslist']))
			$model->attributes=$_GET['Saleslist'];

		// On Change DropDown Paginatio 
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* CSV FILE IMPOR 
	*/
	public function actionCsvImport()
	{
		$msg='';
		$model=new FileImport;
	    $this->performAjaxValidationImport($model);
		if(isset($_POST['FileImport']))
		{
			$model->attributes=$_POST['FileImport'];
			if (CUploadedFile::getInstance($model, 'file')) {
            $uploaddir = dirname(Yii::app()->request->scriptFile) . '/csvFiles/';        
			// logo
            $explogonameLogo = CUploadedFile::getInstance($model, 'file');
            $newlogoname = date("YmdHis") . '_' . $explogonameLogo;
            $file = $uploaddir . '/' . $newlogoname;
            $explogonameLogo->saveAs($file);
            $csvArray=array();
            $csvF= fopen($file,'r');
            while(!feof($csvF))
              $csvArray[]=fgetcsv($csvF,1024);
            fclose($csvF);
            unlink($file);

            foreach ($csvArray as $key => $value) {
            	if($key>0 && !empty($value[1]) && !empty($value[2]) )
            	{
            		$model=new Saleslist;
            		$model->customerName=$value[1];
            		$model->productName=$value[2];
            		$model->date=!empty($value[3]) ? $value[3] : date('Y-m-d');
            		$model->crBy=Yii::app()->user->id;
            		$model->status=Saleslist::STATUS_ACTIVE;
            		if($model->save()) $msg=1;
            	}            	
            }
            if($msg==1) $msg = "<div class='alert alert-success  fade in'><i data-dismiss='alert' class='icon-remove close'></i>Imported Successfully</div>";
            //$model->file = '/csvFiles/' . $newlogoname;
         }
         //echo dirname(Yii::app()->request->scriptFile) . '/csvFiles/';        

			
		}

		$this->render('csvImport',array(
			'model'=>$model,
			'msg'=>$msg,
			
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Saleslist the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Saleslist::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Saleslist $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='saleslist-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}protected function performAjaxValidationImport($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='import-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
