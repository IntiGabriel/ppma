<?php

class ActiveFormTest extends CDbTestCase
{

    public function testError()
    {
        // create form
        $instance = new ActiveForm();

        // create model and validate
        $model = new Entry();
        $model->validate('password');

        $errorMessage = $instance->error($model, 'password');
        $this->assertEquals('<small class="error">Password cannot be blank.</small>', $errorMessage);
    }

}
