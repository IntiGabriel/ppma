<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id'      => 'modal-entry',
    'header'  => 'Add Entry',
    'content' => $this->renderPartial('/entry/_form', array('model' => new Entry()), true),
    'footer'  => array(
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
        TbHtml::button('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    ),
)); ?>


<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id'      => 'modal-password',
    'header'  => 'Change Password',
    'content' => $this->renderPartial('/settings/_password', array('model' => new PasswordForm()), true),
    'footer'  => array(
        TbHtml::button('Close', array('data-dismiss' => 'modal')),
        TbHtml::button('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    ),
)); ?>