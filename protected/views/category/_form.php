<?php
/* @var CategoryController $this */
/* @var Category $model */
/* @var CActiveForm $form */

?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'          => 'category-form',
    'focus'       => array($model, 'name'),
    'htmlOptions' => array('class' => 'custom'),
)); ?>
    <?php /* @var TbActiveForm $form */ ?>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <?php echo $form->labelEx($model, 'parentId'); ?>
    <?php echo $form->dropDownList($model, 'parentId', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
    <?php echo $form->error($model, 'parentId'); ?>

    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>

    <?php echo TbHtml::submitButton('Save <i class="icon-chevron-right icon-white"></i>', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)) ?>

<?php $this->endWidget(); ?>