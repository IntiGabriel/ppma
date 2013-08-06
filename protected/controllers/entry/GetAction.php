<?php


class GetAction extends CAction
{


    protected function all()
    {
        $c        = new CDbCriteria();
        $c->order = 'id DESC';

        $this->response($c);
    }


    protected function recent()
    {
        $c        = new CDbCriteria();
        $c->order = 'id DESC';
        $c->limit = Setting::model()->name(Setting::RECENT_ENTRIES_WIDGET_COUNT)->find()->value;

        $this->response($c);
    }


    protected function response(CDbCriteria $c)
    {
        $models             = Entry::model()->findAll($c);
        $response           = new Response();
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


    public function run()
    {
        $params = explode('/', Yii::app()->request->queryString);

        if (isset($params[2]) && $params[2] == 'recent')
        {
            $this->recent();
        }
        else
        {
            $this->all();
        }
    }

}