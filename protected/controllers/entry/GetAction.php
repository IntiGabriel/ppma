<?php


class GetAction extends CAction
{

    public function run()
    {
        $models = Entry::model()->findAll();
        $json   = array();

        $returnedAttributes = array(
            'id',
            'name',
            'username'
        );

        foreach ($models as $model) {
            $data = $model->getAttributes($returnedAttributes);

            foreach ($data as $index => $value) {
                if ($value == null) {
                    $data[$index] = '';
                }
            }

            $json[] = $data;
        }

        header('Content-type: application/json');
        echo CJSON::encode($json);
    }

}