<h2>Entries</h2>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $model->search(),
    'filter'       => $model,
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