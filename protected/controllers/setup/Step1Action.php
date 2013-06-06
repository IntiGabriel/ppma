<?php


class Step1Action extends CAction
{

    /**
     * @return void
     */
    public function run()
    {
        $continue = true;

        // directories need to be writable
        $pathes = array(
            Yii::getPathOfAlias('webroot.assets'),
            Yii::getPathOfAlias('application.runtime'),
            Yii::getPathOfAlias('application.runtime.sessions'),
            Yii::getPathOfAlias('application.config.ppma') . '.php',
        );

        // check permissions
        $permissions = array();
        foreach ($pathes as $path)
        {
            $permissions[$path] = is_writeable($path);

            if (!$permissions[$path])
            {
                $continue = false;
            }
        }

        // check php version
        $phpVersion = PHP_VERSION >= 5.2;

        if (!$phpVersion)
        {
            $continue = false;
        }

        // check pdo
        $pdoLoaded = extension_loaded('pdo');

        if (!$pdoLoaded)
        {
            $continue = false;
        }

        // check str_getcsv() is available
        $strGetcsvAvailable = function_exists('str_getcsv');

        if ($continue)
        {
            Yii::app()->user->setState('step', 2);
        }

        $this->controller->render('step1', array(
            'permissions'        => $permissions,
            'phpVersion'         => $phpVersion,
            'pdoLoaded'          => $pdoLoaded,
            'strGetcsvAvailable' => $strGetcsvAvailable,
            'continue'           => $continue,
        ));
    }

}