
<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id'      => 'modal-password',
    'header'  => 'Change Password',
    'content' => $this->renderPartial('/settings/_password', array('model' => new PasswordForm()), true),
    'footer'  => array(
        '<span class="ajax-load dialog"></span>',
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
        TbHtml::button('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    ),
)); ?>


<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id'      => 'modal-confirm',
    'header'  => 'Header',
    'keyboard' => false,
    'content' => '<div class="message"></div>',
    'footer'  => array(
        '<span class="ajax-load dialog"></span>',
        TbHtml::button('Cancel', array('class' => 'cancel', 'data-dismiss' => 'modal')),
        TbHtml::button('Yes', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    ),
)); ?>