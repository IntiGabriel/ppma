<?php

class CategoryWidget extends CWidget
{

    /**
     * @var Category[]
     */
    public $models = array();

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
            'models'          => $this->models,
            'renderContainer' => $this->renderContainer,
        ));
    }

}
