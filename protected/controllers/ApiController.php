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
                'actions' => array('entry'),
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
                list($id, $alias, $className) = array('entry-id', 'application.controllers.entry.GetAction', 'GetAction');
                break;

            case 'PUT':
                list($id, $alias, $className) = array('entry-put', 'application.controllers.entry.PutAction', 'PutAction');
                break;

            case 'DELETE':
                list($id, $alias, $className) = array('entry-delete', 'application.controllers.entry.DeleteAction', 'DeleteAction');
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