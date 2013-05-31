<?php
/* @var CategoryController $this */
/* @var Category $model */
/* @var CActiveForm $form */

?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'          => 'category-form',
    'focus'       => array($model, 'name'),
    'htmlOptions' => array('class' => 'custom'),
)); ?>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <?php $this->widget('CategoryDropdownWidget', array('model' => $model, 'form' => $form)) ?>

    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>

    <?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>