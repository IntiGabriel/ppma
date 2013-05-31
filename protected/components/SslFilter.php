<?php

class SslFilter extends CFilter
{

    /**
     * (non-PHPdoc)
     * @see yii/CFilter#preFilter($filterChain)
     */
    protected function preFilter($filterChain)
    {
        if ($filterChain->controller->id == 'setup')
        {
            return true;
        }
        
        if (!Yii::app()->request->isSecureConnection && Yii::app()->settings->getAsBool( Setting::FORCE_SSL ))
        {
            // create ssl-url
            $url = 'https://' . Yii::app()->request->serverName . Yii::app()->request->requestUri;

            // trace
            Yii::trace('Redirect to HTTPS-URL: ' . $url);

            // redirect
            Yii::app()->request->redirect($url);
            return false;
        }
        
        return true;
    }

}