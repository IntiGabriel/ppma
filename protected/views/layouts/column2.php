<?php $this->beginContent('application.views.layouts.main'); ?>

    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/custom-theme/jquery-ui-1.9.2.custom.min.css') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui-1.9.2.custom.min.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/typeahead.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/sidebar.js') ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.bootstrap-growl.min.js') ?>

    <div class="navbar navbar-fixed-tops">
        <div class="navbar-inner">

            <ul class="nav">
                <li class="dropdown">
                    <a href="#entries" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-file"></i> Entries
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo CHtml::link('<i class="icon-list-alt"></i> Overview', array('entry/index')) ?></li>
                        <li><?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', array('entry/create'), array('data-toggle' => 'modal', 'data-target' => '#modal-add-entry')) ?></li>
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
                        <li><?php echo CHtml::link('<i class="icon-pencil"></i> Change Password', array('settings/password')) ?></li>
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
            <?php echo $content; ?>
        </div>

        <aside class="span3" rel="<?php echo CHtml::normalizeUrl(array('settings/setSidebarPositions'))?>">
            <?php $this->renderPartial('//layouts/_sidebar'); ?>
        </aside>

    </div>

    <footer class="row">
        <div class="span12">
            * <a href="http://sourceforge.net/projects/ppma/">ppma</a> (version <?php echo Yii::app()->params['version'] ?>)
            powered by <a href="http://www.yiiframework.com/" target="_blank">Yii Framework</a> (version <?php echo Yii::getVersion() ?>) and
            <a href="http://twitter.github.io/bootstrap/" target="_blank">Bootstrap</a> (version 2.3.2)
        </div>
    </footer>

    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/update-entry.js'); ?>
    <?php $this->beginWidget('ext.EModal.EModal', array('id' => 'entry-form-modal')); ?>
        <h2>Update entry</h2>
        <?php $this->renderPartial('/entry/_form', array('model' => new Entry())); ?>
    <?php $this->endWidget(); ?>

<?php $this->endContent(); ?>