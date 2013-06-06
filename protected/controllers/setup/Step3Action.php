<?php


class Step3Action extends CAction
{

    /**
     * @return void
     */
    public function run()
    {
        // create model
        $model = new User();

        // create form and add model
        $form = new CForm('application.views.setup.forms.register', $model);

        // form is submitted
        if ($form->submitted('register'))
        {
            // attach eventhandler for padding password, generating encryption key and salting password
            $model->onBeforeValidate[] = array($model, 'padPassword');
            $model->onBeforeValidate[] = array($model, 'generateEncryptionKey');
            $model->onBeforeValidate[] = array($model, 'saltPassword');

            // validate form
            if ($form->validate())
            {
                // save user
                $model->isAdmin = true;
                $model->save(false);

                // set step in session and redirect
                Yii::app()->user->setState('step', 4);
                $this->controller->redirect(array('setup/', 'step' => 4));
            }
        }

        $this->controller->render('step3', array('form' => $form));
    }

}