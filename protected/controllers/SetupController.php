<?php

class SetupController extends Controller
{

    /**
     * @var string
     */
    public $layout = 'setup';

    /**
     *
     * @return void
     */
    public function actionIndex()
    {
        // get step
        $step = Yii::app()->request->getQuery('step', 1);

        if ($step > Yii::app()->user->getState('step', 1))
        {
            $this->redirect(array('setup/index', 'step' => Yii::app()->user->getState('step', 1)));
        }

        $this->processStep($step);
    }

    /**
     * @param int $step
     */
    protected function processStep($step)
    {
        $name  = sprintf('Step%dAction', $step);
        $alias = 'application.controllers.setup.' . $name;

        // check if Action is exist
        if (!file_exists(Yii::getPathOfAlias($alias) . '.php'))
        {
            $this->processStep(1);
            return;
        }

        // import action
        Yii::import($alias);

        // run action
        $this->runAction(new $name($this, $name));
    }

}