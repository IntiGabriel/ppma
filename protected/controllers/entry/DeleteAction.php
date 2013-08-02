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
        $response = array(
            'error'    => true,
            'messages' => array()
        );


        if ($model instanceof Entry)
        {
            $model->delete();

            $response['error']      = false;
            $response['messages'][] = 'Entry deleted!';
        }
        else
        {
            $response['messages'][] = 'Entry does not exist';
        }

        JSON::response($response);
    }

}