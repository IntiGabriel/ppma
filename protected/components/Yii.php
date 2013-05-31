<?php

/**
 * Class Yii (only for working autocompletion in IDE)
 */
class Yii extends YiiBase
{

    /**
     * @return Application
     */
    public static function app() {
        return new Application();
    }

}


/**
 * Class Application
 *
 * @property WebUser           $user
 * @property SecurityManager   $securityManager
 * @property SettingsComponent $settings
 */
class Application extends CWebApplication { }