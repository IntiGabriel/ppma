<?php
    // set breadcrumbs
    $this->breadcrumbs = array(
        'Entries' => array('index'),
        'Manage',
    );

    // register scripts
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/toggle-search.js');
?>

<h2>Manage Entries</h2>


<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="alert-box success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        <a href="" class="close">&times;</a>
    </div>
<?php endif; ?>

<?php echo TbHtml::buttonGroup(array(
    array('label' => '<i class="icon-plus-sign"></i> Add Entry', 'data-toggle' => 'modal', 'data-target' => '#modal-add-entry'),
    array('label' => '<i class="icon-search"></i> Advanced Search', 'class' => 'search-button'),
)); ?>


<div class="search-form">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $model->search(),
    'type'         => TbHtml::GRID_TYPE_STRIPED,
	'columns'      => array(
        'name',
        'username',
        array(
            'name'  => 'tagList',
            'value' => '$data->getTagList(true)',
            'type'  => 'raw',
        ),
        array(
            'class' => 'EntryButtonColumn',
        ),
	),
)); ?>