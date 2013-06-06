<?php


class Step2Action extends CAction
{

    /**
     * @return void
     */
    public function run()
    {
        $form = new CForm('application.views.setup.forms.step2', new CreateConfigForm());

        // get model of form
        $model = $form->model;
        /* @var CreateConfigForm $model */

        // form is submitted & valid
        if ($form->submitted('create') && $form->validate())
        {
            $configPath = Yii::getPathOfAlias('application.config.ppma') . '.php';

            // get config
            $config = require($configPath);

            // set config
            $config['db']['server']   = $model->server;
            $config['db']['username'] = $model->username;
            $config['db']['password'] = $model->password;
            $config['db']['name']     = $model->name;
            $config['timezone']       = $model->timezone;

            // save config
            $config = new CConfiguration($config);
            file_put_contents($configPath, "<?php\n\nreturn " . $config->saveAsString() . ';');

            // create and fill tables
            $this->createTables();
            $this->fillTables();

            // set step in session and redirect
            Yii::app()->user->setState('step', 3);
            $this->controller->redirect(array('/setup/index', 'step' => 3));
        }

        // form is submitted & invalid
        else if ($form->submitted('create'))
        {
            // if connection test failed, show error summary
            if ($form->model->hasErrors('db'))
            {
                $form->showErrorSummary = true;
            }
        }

        // set config in form
        else
        {
            // get config
            $configPath = Yii::getPathOfAlias('application.config.ppma') . '.php';
            $config = require($configPath);

            $model->server   = $config['db']['server'];
            $model->username = $config['db']['username'];
            $model->password = $config['db']['password'];
            $model->name     = $config['db']['name'];
            $model->timezone = $config['timezone'];
        }

        $this->controller->render('step2', array('form' => $form));
    }


    /**
     * @return void
     */
    protected function createTables()
    {
        $command = Yii::app()->db->createCommand();

        // create Entry-table
        try {
            $command->dropTable('Entry');
        } catch (Exception $e) { }

        $command->createTable('Entry', array(
            'id'                => 'pk',
            'userId'            => 'integer NOT NULL',
            'name'              => 'string',
            'url'               => 'string',
            'comment'           => 'text',
            'username'          => 'string',
            'encryptedPassword' => 'binary',
            'viewCount'         => 'int NOT NULL DEFAULT 0'
        ));

        // create EntryHasTag-table
        try {
            $command->dropTable('EntryHasTag');
        } catch (Exception $e) { }

        $command->createTable('EntryHasTag', array(
            'entryId' => 'integer NOT NULL',
            'tagId'   => 'integer NOT NULL',
            'PRIMARY KEY (entryId, tagId)',
        ));

        // create Tag-table
        try {
            $command->dropTable('Tag');
        } catch (Exception $e) { }

        $command->createTable('Tag', array(
            'id'     => 'pk',
            'name'   => 'string',
            'userId' => 'integer NOT NULL',
        ));

        // create User-table
        try {
            $command->dropTable('User');
        } catch (Exception $e) { }

        $command->createTable('User', array(
            'id'            => 'pk',
            'username'      => 'string',
            'password'      => 'string',
            'salt'          => 'string',
            'encryptionKey' => 'binary',
            'isAdmin'       => 'boolean',
        ));

        // create Setting-table
        try {
            $command->dropTable('Setting');
        } catch (Exception $e) { }

        $command->createTable('Setting', array(
            'id'    => 'pk',
            'name'  => 'string NOT NULL',
            'value' => 'string NOT NULL',
        ));


    }

    /**
     * @return void
     */
    public function fillTables()
    {
        // create "force ssl" default value
        $forceSsl = new Setting();
        $forceSsl->name  = Setting::FORCE_SSL;
        $forceSsl->value = 0;
        $forceSsl->save();

        // add settings for recenent-entries-widget
        $model = new Setting();
        $model->name  = Setting::RECENT_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name  = Setting::RECENT_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();

        $model = new Setting();
        $model->name = Setting::RECENT_ENTRIES_WIDGET_POSITION;
        $model->value = 2;
        $model->save(false);

        // add settings for "Most Viewed" widget
        $model = new Setting();
        $model->name  = Setting::MOST_VIEWED_ENTRIES_WIDGET_COUNT;
        $model->value = 10;
        $model->save();

        $model = new Setting();
        $model->name  = Setting::MOST_VIEWED_ENTRIES_WIDGET_ENABLED;
        $model->value = true;
        $model->save();

        $model = new Setting();
        $model->name = Setting::MOST_VIEWED_ENTRIES_WIDGET_POSITION;
        $model->value = 1;
        $model->save(false);

        // add settings for "Tag Cloud" widget
        $model = new Setting();
        $model->name = Setting::TAG_CLOUD_WIDGET_POSITION;
        $model->value = 0;
        $model->save(false);
    }

}