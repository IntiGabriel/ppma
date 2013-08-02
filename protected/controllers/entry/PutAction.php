<?php


class PutAction extends CAction
{

    public function run()
    {
        $request = Yii::app()->request;

        // create response
        $response = array(
            'error'    => true,
            'messages' => array(),
            'data'     => array(),
        );

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
            $response['error']      = false;
            $response['messages'][] = 'The entry was created successfully.';
            $response['data']['id'] = $model->id;
        }
        else
        {
            $response['messages'] = array_values($model->getErrors());
        }

        JSON::response($response);
    }

}