<?php

class CategoryTreeWidget extends CWidget
{

    /**
     * @var CActiveRecord
     */
    public $model;

    /**
     * @var string
     */
    public $attribute = 'categoryIds';

    /**
     * @var Category[]
     */
    public $categories = array();

    /**
     * @var bool
     */
    public $renderContainer = true;


    /**
     * @return void
     */
    public function run()
    {
        parent::run();

        $this->render('view', array(
            'model'           => $this->model,
            'attribute'       => $this->attribute,
            'categories'      => $this->categories,
            'renderContainer' => $this->renderContainer,
        ));
    }

}
