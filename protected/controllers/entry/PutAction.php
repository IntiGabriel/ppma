<?php


class PutAction extends CAction
{

    public function run()
    {
        $request = Yii::app()->request;

        // create response
        $response = new Response();

        // create model
        $model = new Entry();

        // get data and set to model
        $_POST           = CJSON::decode($request->getRawBody());
        $model->name     = $request->getPost('name');
        $model->username = $request->getPost('username');
        $model->password = $request->getPost('password');

        // save model
        if($model->save())
        {
            // tracing
            Yii::trace('Entry created (ID:  ' . $model->id . ')');

            // set message
            $response
                ->addMessage('The entry was created successfully.')
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