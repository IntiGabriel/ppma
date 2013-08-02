<?php


class DeleteAction extends CAction
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


        if ($model instanceof Entry)
        {
            $model->delete();
            $response->addMessage('Entry deleted!');
        }
        else
        {
            $response
                ->setError(true)
                ->addMessage('Entry does not exist');
        }

        $response->send();
    }

}