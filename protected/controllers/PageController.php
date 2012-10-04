<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    /**
     * Настройки для QTreeGridView.
     *
     * @var array Массив настроек для QTreeGridView
     */
    public $CQtreeGreedView = array(
        // название класса
        'modelClassName' => 'Page',
        // действие, где выводится QTreeGridView.
        // Сюда будет идти редирект с других действий
        'adminAction' => 'index',
    );

    /**
     * Действия для QTreeGridView.
     * @return array Массив действий для QTreeGridView
     */
    public function actions() {
        return array (
            'create'=>'ext.QTreeGridView.actions.Create',
            'update'=>'ext.QTreeGridView.actions.Update',
            'delete'=>'ext.QTreeGridView.actions.Delete',
            'moveNode'=>'ext.QTreeGridView.actions.MoveNode',
            'makeRoot'=>'ext.QTreeGridView.actions.MakeRoot',
        );
    }

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','delete','moveNode','makeRoot'),
				'users'=>array('admin'),
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
		$model=new Page;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
            $model->setScenario(Page::SCENARIO_CREATE);

            $this->saveModel($model);
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

        $model->setScenario($model->isRoot() ? Page::SCENARIO_UPDATE_ROOT: Page::SCENARIO_UPDATE);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
            $this->saveModel($model);
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
			$this->redirect(Yii::app()->request->getPost('returnUrl', array('admin')));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Page('search');
		$model->unsetAttributes();  // clear any default values

		if ($page = Yii::app()->request->getParam('Page')) {
            $model->attributes = $page;
        }

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
     *
	 * @param integer ID модели которую необходимо загрузить
	 */
	public function loadModel($id)
	{
		$model = Page::model()->findByPk($id);
		if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested model does not exist.'));
        }
		return $model;
	}

	/**
	 * Производит Ajav валидацию модели.
     *
	 * @param Page Модель для валидации
	 */
	protected function performAjaxValidation(Page $model)
	{
		if (Yii::app()->request->getPost('ajax') === 'page-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
     * Выполняет сохранение модели, учитывая наличие POST параметра commit.
     * Если параметр commit отсутсвует - производит перенаправление на действие view.
     * Добавляет flash сообщение об успешном сохранении модели.
     *
     * @param Page Модель для сохранения
     */
    protected function saveModel(Page $model)
    {
        if ($model->saveNode()) {
            Yii::app()->user->setFlash('success',
                Yii::t('app', Page::MSG_MODEL_SAVED, array('{title}' => $model->title)));

            if (Yii::app()->request->getPost('commit')) {
                $this->redirect(array('view','id'=>$model->id));
            }
        }
    }
}
