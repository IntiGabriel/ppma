<?php


class ApiController extends Controller
{

    /**
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('entry', 'password'),
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
    public function actionEntry()
    {
        $id = $alias = $className = null;

        switch (Yii::app()->request->requestType) {
            case 'GET':
                list($id, $alias, $className) = array('entry-get', 'application.controllers.entry.GetAction', 'GetAction');
                break;

            case 'POST':
            case 'PUT':
                list($id, $alias, $className) = array('entry-postput', 'application.controllers.entry.PostPutAction', 'PostPutAction');
                break;

            case 'DELETE':
                list($id, $alias, $className) = array('entry-delete', 'application.controllers.entry.DeleteAction', 'DeleteAction');
        }

        Yii::import($alias);
        $this->runAction(new $className($this, $id));
    }


    /**
     * @return void
     */
    public function actionPassword()
    {
        $id = $alias = $className = null;

        switch (Yii::app()->request->requestType) {
            case 'GET':
                list($id, $alias, $className) = array('password-get', 'application.controllers.Password.GetAction', 'GetAction');
                break;
        }

        Yii::import($alias);
        $this->runAction(new $className($this, $id));
    }


    /**
     * @return array
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
            'ajaxOnly',
            'postOnly + create',
        ), parent::filters());
    }

}