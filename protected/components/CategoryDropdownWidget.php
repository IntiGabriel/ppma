<?php

class CategoryDropdownWidget extends CWidget
{

    /**
     * @var Category
     */
    public $model;


    /**
     * @var ActiveForm
     */
    public $form;


    /**
     * @return void
     */
    public function init()
    {
        parent::init();

        if ($this->model === null)
        {
            $this->model = new Category();
        }

        if ($this->form === null)
        {
            $this->form = new ActiveForm();
        }
    }


    /**
     * @return void
     */
    public function run()
    {
        parent::run();

        $this->render(lcfirst(__CLASS__), array(
            'model' => $this->model,
            'form'  => $this->form,
        ));
    }


}
