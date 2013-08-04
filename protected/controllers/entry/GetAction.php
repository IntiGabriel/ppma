<?php


class GetAction extends CAction
{

    public function run()
    {
        $models   = Entry::model()->findAll();
        $response = new Response();

        $returnedAttributes = array(
            'id',
            'name',
            'username',
            'url',
            'comment'
        );

        foreach ($models as $model) {
            $data = $model->getAttributes($returnedAttributes);

            foreach ($data as $index => $value) {
                if ($value == null) {
                    $data[$index] = '';
                }
            }

            $response->addData($data);
        }

        $response->send();
    }

}