<?php

class SetupFilter extends CFilter
{

    /**
     * (non-PHPdoc)
     * @see yii/CFilter#preFilter($filterChain)
     */
    protected function preFilter($filterChain)
    {
        // if app isn't installed & current controller isn't SetupController -> redirect to /setup
        if (!Yii::app()->params['isInstalled'] && $filterChain->controller->id != 'setup')
        {
            // tracing
            Yii::trace('Redirect to SetupController');

            // redirect to setup controller
            $filterChain->controller->redirect(array('setup/'));
            return false;
        }

        // if app is installed & current controller is SetupController -> redirect to homeUrl
        else if (Yii::app()->params['isInstalled'] && $filterChain->controller->id == 'setup')
        {
            // tracing
            Yii::trace('Redirect to home-URL: ' . Yii::app()->homeUrl);

            $filterChain->controller->redirect(Yii::app()->homeUrl);
            return false;
        }

        return true;
    }

}