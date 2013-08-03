<?php


class GetAction extends CAction
{

    public function run()
    {
        $matches = null;
        preg_match('/\d+$/', Yii::app()->request->queryString, $matches);

        if (!isset($matches[0]))
        {
            throw new CHttpException(400);
        }

        $id       = $matches[0];
        $model    = Entry::model()->findByPk($id);
        $response = new Response();

        $response->addData($model->password, 'password');
        $response->send();
    }

}