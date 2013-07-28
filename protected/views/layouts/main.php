<?php $this->beginContent('application.views.layouts.master'); ?>

    <div class="container-fluid">
        <?php echo $content; ?>
    </div>

    <?php $this->renderPartial('/layouts/_modals'); ?>

<?php $this->endContent(); ?>