<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form ActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'      => Yii::app()->createUrl($this->route),
	'method'      => 'get',
    'htmlOptions' => array('class' => 'custom'),
)); ?>
    <?php /* @var TbActiveForm $form */ ?>

    <?php echo $form->label($model, 'parentId'); ?>
    <?php echo $form->dropDownList($model, 'parentId', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>

    <?php echo $form->label($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>

    <?php echo TbHtml::submitButton('Search <i class="icon-search"></i>', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)) ?>

    <hr />

<?php  $this->endWidget(); ?>
