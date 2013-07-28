<?php /* @var LoginForm $model */ ?>

<?php Yii::app()->clientScript->registerScriptFile('js/login.js') ?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'login-form',
    'focus' => array($model, 'username'),
)); ?>

    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username'); ?>
    <?php echo $form->error($model, 'username'); ?>

    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password'); ?>
    <?php echo $form->error($model, 'password'); ?>

        <div class="pull-right">
            <button class="btn btn-primary">
                Login <i class="icon-chevron-right icon-white"></i>
            </button>
        </div>

<?php $this->endWidget(); ?>