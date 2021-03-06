<?php

class TagController extends Controller
{

    /**
     *
     * @var string
     */
    public $layout = 'column2';


    /**
     * @param int $id
     * @return CActiveRecord
     * @throws CHttpException
     */
    protected function _loadModel($id)
    {
        $model = Tag::model()->findbyPk($id);

        if ($model === null)
        {
            throw new CHttpException(404);
        }
        else if ($model->userId != Yii::app()->user->id)
        {
            throw new CHttpException(403);
        }

        return $model;
    }


    /**
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('create', 'delete', 'index', 'update'),
                'users'   => array('@'),
            ),
            array(
                'deny',
                'users'   => array('*'),
            ),
        );
    }
    
    
    /**
     * @return void
     */
    public function actionCreate()
    {
        // create model
        $model = new Tag('create');

        // form is submitted
        if(isset($_POST['Tag']))
        {
            $model->attributes = $_POST['Tag'];

            // save model & redirect to list
            if($model->save())
            {
                // set flash
                Yii::app()->user->setFlash('success', 'The tag was created successfully.');

                // redirect to index
                $this->redirect(array('index'));
            }
        }

        // render view
        $this->render('create', array('model' => $model));
    }
    
    
    /**
     * @param int $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        // we only allow deletion via POST request
        if(!Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400);
        }

        // get model
        $model = $this->_loadModel($id);

        // delete entry
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!Yii::app()->request->isAjaxRequest)
        {
            $this->redirect(array('index'));
        }
    }
    
    
    /**
     * @return void
     */
    public function actionIndex()
    {
        $model = new Tag('search');
        $model->userId = Yii::app()->user->id;

        if(isset($_GET['Tag']))
        {
            $model->attributes = $_GET['Tag'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
        
    }

    
    /**
     * @param int $id
     * @return void
     */
    public function actionUpdate($id)
    {
        // get model
        $model = $this->_loadModel($id);

        // check if form submitted and valid
        if(isset($_POST['Tag']))
        {
            $model->attributes = $_POST['Tag'];

            // save entry
            if($model->save())
            {
                // set flash
                Yii::app()->user->setFlash('success', 'The tag was updated successfully.');

                // redirect to index
                $this->redirect(array('index'));
            }
        }

        // render view
        $this->render('update', array('model' => $model));
    }
    

    /**
     * (non-PHPdoc)
     * @see yii/web/CController#filters()
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
        ), parent::filters());
    }

}
