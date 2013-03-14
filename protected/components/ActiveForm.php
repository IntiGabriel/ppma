<?php

class ActiveForm extends CActiveForm
{

    /**
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @param bool $enableAjaxValidation
     * @param bool $enableClientValidation
     * @return mixed|string
     */
    public function error($model, $attribute, $htmlOptions = array(), $enableAjaxValidation = true, $enableClientValidation = true)
    {
        return str_replace(
            array('div', 'errorMessage'),
            array('small', 'error'),
            parent::error($model, $attribute, $htmlOptions, $enableAjaxValidation, $enableClientValidation)
        );
    }

}