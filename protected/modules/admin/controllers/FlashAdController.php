<?php

class FlashAdController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

        public function filters() {
        return array('rights',);
        }

        public function allowedActions() {
            return 'index, view';
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
		$model=new FlashAd;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FlashAd']))
		{
			$model->attributes=$_POST['FlashAd'];
                        $img = CUploadedFile::getInstance($model, 'pic');
                        if($img){
                        if($img->size > 2000000){
                            $img_size = ($img->size)/1000;
                           echo '<script>alert("图片大小为'.$img_size.'KB,请小于2M")</script>';
                        }else{
                        $extensionName = explode('.', $img->getName());
                        $extensionName = $extensionName[count($extensionName) - 1];

                        $day_file = date('Y-m-d', time());
                        $path = dirname(Yii::app()->basePath) . '/upload/ad/';
                        $img_src = $path. md5(time()) .'.'. $extensionName;
                        $img1 = md5(time()) .'.'. $extensionName;
                        $model->pic = $img1;
                        }}else{
                           echo '<script>alert("请上传图片.")</script>';
                        }

			if($model->save()){
                            $img -> saveAs($img_src);
				$this->redirect(array('admin'));
                        }
		}

		$this->render('create',array(
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['FlashAd']))
		{
			$model->attributes=$_POST['FlashAd'];
                        $FlashAd = FlashAd::model()->findByPk($id);
                        $img = $_FILES['FlashAd']['name']['pic'];
                        if($img !== ''){
                        $img = CUploadedFile::getInstance($model, 'pic');
                        $extensionName = explode('.', $img->getName());
                        $extensionName = $extensionName[count($extensionName) - 1];

                        $path = dirname(Yii::app()->basePath) . '/upload/ad/';
                        $img_src = $path. md5(time()) .'.'. $extensionName;
                        $img1 = md5(time()) .'.'. $extensionName;
                        $model->pic = $img1;
                        }else{
                        $model->pic = $FlashAd->pic;
                        }

                        
			if($model->save()){
                            if($img !== ''){
                            @unlink(dirname(Yii::app()->basePath).'/upload/ad/'.$FlashAd->pic);
                            $img -> saveAs($img_src);
                            }
		            $this->redirect(array('admin'));
                        }
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FlashAd');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FlashAd('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FlashAd']))
			$model->attributes=$_GET['FlashAd'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=FlashAd::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='flash-ad-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
