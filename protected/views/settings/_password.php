<?php
/* @var PasswordForm $model */
/* @var TbActiveForm $form */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'     => 'password-form',
    'action' => array('settings/password'),
    'focus'  => array($model, 'name'),
)); ?>

    <?php echo $form->labelEx($model, 'oldPassword'); ?>
    <?php echo $form->passwordField($model, 'oldPassword'); ?>
    <?php echo $form->error($model, 'oldPassword'); ?>

    <?php echo $form->labelEx($model, 'newPassword'); ?>
    <?php echo $form->passwordField($model, 'newPassword'); ?>
    <?php echo $form->error($model, 'newPassword'); ?>

    <?php echo $form->labelEx($model, 'newPasswordRepeat'); ?>
    <?php echo $form->passwordField($model, 'newPasswordRepeat'); ?>
    <?php echo $form->error($model, 'newPasswordRepeat'); ?>

<?php $this->endWidget(); ?>