<?php

class CategoryController extends Controller
{

    public $layout = '//layouts/column2';

    /**
     * @return array
     */
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }


    /**
     * @return array
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * @param integer $id
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        // create model
        $model = new Category();

        // form is submitted
        if (isset($_POST['Category'])) {
            // set form to model
            $model->attributes = $_POST['Category'];

            // validate & save form
            if ($model->save()) {

                Yii::app()->user->setFlash('success', 'The category was created successfully.');

                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        // load model
        $model = $this->loadModel($id);

        // form is submitted
        if (isset($_POST['Category']))
        {
            // set form to model
            $model->attributes = $_POST['Category'];

            // validate & save model
            if ($model->save())
            {
                Yii::app()->user->setFlash('success', 'The category was saved successfully.');
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * @param integer $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * @return void
     */
    public function actionIndex()
    {
        $model = new Category('search');

        if (isset($_GET['Category']))
        {
            $model->attributes = $_GET['Category'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }


    /**
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Category::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

}
