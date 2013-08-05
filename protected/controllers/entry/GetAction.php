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
            'comment',
            'categoryId',
        );

        foreach ($models as $model) {
            /* @var Entry $model */

            $data = $model->getAttributes($returnedAttributes);

            foreach ($data as $index => $value) {
                if ($value == null) {
                    $data[$index] = '';
                }
            }

            // add tagList
            $data['tagList'] = $model->getTagList();

            $response->addData($data);
        }

        $response->send();
    }

}