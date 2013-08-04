<?php $this->beginContent('application.views.layouts.master'); ?>

    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/vendor/jquery.tagsinput.css') ?>

    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/jquery.tagsinput-1.3.2.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/spin.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/jquery.spin.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/jquery.bootstrap-growl.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/underscore.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/backbone.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/mousetrap-1.1.4.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/AjaxLoader.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/Growl.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/model/Entry.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/model/Password.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/collection/Entries.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/view/Navigation.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/view/ConfirmModal.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/view/entry/Row.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/view/entry/Modal.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/view/entry/Index.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/view/settings/Modal.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ppma/App.js') ?>

    <div class="container-fluid">

        <div id="navigation" class="navbar navbar-fixed-tops">
            <div class="navbar-inner">

                <ul class="nav">
                    <li class="dropdown">
                        <a href="#entries" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-file"></i> Entries
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('<i class="icon-list-alt"></i> Overview', array('entry/index')) ?></li>
                            <li><?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', array('entry/create'),
                                    array('class' => 'show-entry-modal')) ?></li>
                            <li class="divider"></li>
                            <li><?php echo CHtml::link('<i class="icon-download"></i> Export to CSV', array('export/csv')) ?></li>
                            <li><?php echo CHtml::link('Import from CSV', array('import/csv')) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#categories" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-folder-open"></i> Categories
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('<i class="icon-list-alt"></i> Overview', array('category/index')) ?></li>
                            <li><?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', array('category/create')) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#tags" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-tags"></i> Tags
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('<i class="icon-list-alt"></i> Overview', array('tag/index')) ?></li>
                            <li><?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', array('tag/create')) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#settings" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-wrench"></i> Settings
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('<i class="icon-cog"></i> General', array('settings/application')) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#profile" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Profile
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('<i class="icon-pencil"></i> Change Password', '#user/password',
                                    array('class' => 'show-password-modal')) ?></li>
                            <li><?php echo CHtml::link('<i class="icon-off"></i> Logout', array('/user/logout')) ?></li>
                        </ul>
                    </li>
                </ul>

                <form action="<?php echo CHtml::normalizeUrl(array('entry/index')) ?>" method="get" class="navbar-search pull-right">
                    <input type="search" class="search-query" name="q" value="<?php echo Yii::app()->request->getParam('q') ?>"
                           rel="<?php echo Yii::app()->createAbsoluteUrl('entry/searchName') ?>" placeholder="Search" />
                </form>

            </div>
        </div>

        <div class="row-fluid">
            <div class="span9" role="content" id="content">
                <span class="ajax-load content"></span>
                <?php echo $content; ?>
            </div>

            <aside class="span3" rel="<?php echo CHtml::normalizeUrl(array('settings/setSidebarPositions'))?>">
                <?php $this->renderPartial('//layouts/_sidebar'); ?>
            </aside>

        </div>

        <footer class="row">
            <div class="span12">
                * <a href="http://sourceforge.net/projects/ppma/">ppma</a> (version <?php echo Yii::app()->params['version'] ?>)
                powered by <a href="http://www.yiiframework.com/" target="_blank">Yii</a> (version <?php echo Yii::getVersion() ?>),
                <a href="http://backbonejs.org/" target="_blank">Backbone.js</a> (version 1.0.0) &
                <a href="http://twitter.github.io/bootstrap/" target="_blank">Bootstrap</a> (version 2.3.2)
            </div>
        </footer>

    </div>

    <?php $this->renderPartial('/layouts/_modals'); ?>

<?php $this->endContent(); ?>