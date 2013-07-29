<?php
    /* @var Entry $model */
    /* @var CActiveForm $form */

    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/jquery.passwordgenerator.min.js');
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'          => 'entry-form',
    'action'      => $this->createUrl('entry/create'),
    'focus'       => array($model, 'name'),
    'htmlOptions' => array('class' => 'custom'),
)); ?>
    <?php /* @var TbActiveForm $form */ ?>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <div class="row-fluid" style="margin-bottom: 10px">
        <?php $this->widget('yiiwheels.widgets.multiselect.WhMultiSelect', array(
            'name' => 'Entry[categoryIds]',
            'data' => CHtml::listData(Category::model()->findAll(), 'id', 'name'),
        )); ?>
    </div>

    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>

    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username'); ?>
    <?php echo $form->error($model, 'username'); ?>

    <?php echo $form->labelEx($model, 'password'); ?>
    <div class="input-append">
        <?php echo $form->passwordField($model, 'password', array('required' => 'true')); ?>
        <div class="add-on">
            <a class="generate-password"><i class="icon-random"></i></a>
        </div>
        <div class="add-on">
            <a class="toggle-password"><i class="icon-eye-open"></i></a>
        </div>
    </div>
    <?php echo $form->error($model, 'password'); ?>

    <?php echo $form->labelEx($model, 'url'); ?>
    <?php echo $form->urlField($model, 'url', array('placeholder' => 'http://www.example.com')); ?>
    <?php echo $form->error($model, 'url'); ?>

    <?php echo $form->labelEx($model, 'tagList'); ?>
    <?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
        'asDropDownList' => false,
        'name'           => 'tagList',
        'pluginOptions'  => array(
            'tags'            => array_keys( CHtml::listData(Tag::model()->findAll(), 'name', 'name') ),
            'tokenSeparators' => array(',', ' ')
    ))); ?>
    <?php echo $form->error($model, 'tagList'); ?>



    <?php echo $form->labelEx($model, 'comment'); ?>
    <?php echo $form->textArea($model, 'comment', array('rows' => 5)); ?>
    <?php echo $form->error($model, 'comment'); ?>

<?php $this->endWidget(); ?>