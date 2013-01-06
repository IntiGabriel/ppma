<?php

class HttpSession extends CHttpSession
{

    /**
     * @return void
     */
    public function init()
    {
        $savePath = Yii::getPathOfAlias('application.runtime.sessions');

        if (file_exists($savePath) && is_writable($savePath))
        {
            $this->savePath = $savePath;
        }

        parent::init();
    }

}
