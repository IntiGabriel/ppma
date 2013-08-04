<?php


class PostPutAction extends CAction
{

    public function run()
    {
        $request = Yii::app()->request;
        $_POST   = CJSON::decode($request->getRawBody());

        // create response
        $response = new Response();

        // create model
        if ($request->getPost('id', false))
        {
            $model = Entry::model()->findByPk($request->getPost('id'));
            $model->scenario = 'update';

            if (!is_object($model))
            {
                throw new CHttpException(404);
            }
        }
        else
        {
            $model = new Entry('create');
        }

        // set data to model
        $model->name     = $request->getPost('name');
        $model->username = $request->getPost('username');
        $model->password = $request->getPost('password');
        $model->url      = $request->getPost('url');
        $model->comment  = $request->getPost('comment');
        $model->tagList  = $request->getPost('tagList');

        // save model
        if($model->save())
        {
            // tracing
            Yii::trace('Entry created (ID:  ' . $model->id . ')');

            // set message
            $response
                ->addMessage('The entry was saved successfully.')
                ->addData($model->id, 'id');
        }
        else
        {
            $response
                ->setError(true)
                ->addMessages( array_values($model->getErrors()) );
        }

        $response->send();
    }

}