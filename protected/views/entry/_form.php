<?php
    /* @var Entry $model */
    /* @var CActiveForm $form */

    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/toggle-password.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/generate-password.js');
?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'entry-form',
    'focus'       => array($model, 'name'),
    'htmlOptions' => array('class' => 'custom'),
)); ?>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <?php echo $form->labelEx($model, 'categories'); ?>
    <?php $this->widget('ext.CategoryTreeWidget.CategoryTreeWidget', array(
        'categories' => Category::model()->onlyRootLevel()->orderByNameAsc()->findAll(),
        'model'      => $model,
    )); ?>

    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>

    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username'); ?>
    <?php echo $form->error($model, 'username'); ?>

    <?php echo $form->labelEx($model, 'password'); ?>
    <div class="row collapse">
        <div class="ten columns">
            <?php echo $form->passwordField($model, 'password', array('required' => 'true')); ?>
        </div>
        <div class="one columns">
            <a class="postfix first button secondary expand generate-password"><i class="foundicon-access-key"></i></a>
        </div>
        <div class="one columns">
            <a class="postfix second button secondary expand show-hide-password"><i class="foundicon-access-eyeball"></i></a>
        </div>
    </div>
    <?php echo $form->error($model, 'password'); ?>

    <?php echo $form->labelEx($model, 'url'); ?>
    <?php echo $form->urlField($model, 'url', array('placeholder' => 'http://www.example.com')); ?>
    <?php echo $form->error($model, 'url'); ?>

    <?php echo $form->labelEx($model, 'tagList'); ?>
    <?php echo $form->textField($model, 'tagList'); ?>
    <?php echo $form->error($model, 'tagList'); ?>

    <?php echo $form->labelEx($model, 'comment'); ?>
    <?php echo $form->textArea($model, 'comment', array('rows' => 5)); ?>
    <?php echo $form->error($model, 'comment'); ?>

    <?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>