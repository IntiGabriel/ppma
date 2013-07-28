<?php $this->beginContent('application.views.layouts.master'); ?>

    <div class="container-fluid">
        <?php echo $content; ?>
    </div>

    <?php $this->widget('bootstrap.widgets.TbModal', array(
        'id'      => 'modal-add-entry',
        'header'  => 'Add Entry',
        'content' => $this->renderPartial('/entry/_form', array('model' => new Entry()), true),
        'footer'  => array(
            TbHtml::button('Close', array('data-dismiss' => 'modal')),
            TbHtml::button('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        ),
    )); ?>

<?php $this->endContent(); ?>