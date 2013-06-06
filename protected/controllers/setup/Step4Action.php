<?php


class Step4Action extends CAction
{

    /**
     * @return void
     */
    public function run()
    {
        // Remove step from session
        Yii::app()->user->setState('step', 0, 0);

        // Flag app as installed
        $path = Yii::getPathOfAlias('application.config.ppma') . '.php';
        $config = require($path);
        $config['isInstalled'] = true;
        $config = new CConfiguration($config);
        file_put_contents($path, "<?php\n\nreturn " . $config->saveAsString() . ';');

        $this->controller->render('step4');
    }

}