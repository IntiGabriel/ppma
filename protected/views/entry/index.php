<script id="entry-index-template" type="text/template">
    <h2>Entries</h2>
    <div class="grid"></div>
</script>


<script id="entry-grid-template" type="text/template">
    <table id="entry-list" class="table table-striped">
        <thead>
            <tr>
                <th class="sortable" rel="id">ID <i /></th>
                <th class="sortable" rel="name">Name <i /></th>
                <th class="sortable" rel="username">Username <i /></th>
                <th>Tags</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</script>


<script id="entry-row-template" type="text/template">
    <td class="id">{{ id }}</td>
    <td class="name">{{ name }}</td>
    <td class="username">{{ username }}</td>
    <td class="tag-list">{{ tagList }}</td>
    <td class="button-column">
        <a href="#delete-{{ id }}" class="delete" rel="{{ id }}"><i class="icon-remove"></i></a>
        <a href="#edit-{{ id }}" class="edit" rel="{{ id }}"><i class="icon-edit"></i></a>
    </td>
</script>


<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id'       => 'modal-entry',
    'keyboard' => false,
    'header'   => 'Add Entry',
    'content'  => $this->renderPartial('/entry/_form', array('model' => new Entry()), true),
    'footer'   => array(
        '<span class="ajax-load dialog"></span>',
        TbHtml::button('Close', array('class' => 'cancel')),
        TbHtml::button('Save', array('class' => 'save', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    ),
)); ?>