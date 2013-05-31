<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form ActiveForm */
?>

<?php $form = $this->beginWidget('ActiveForm', array(
	'action'      => Yii::app()->createUrl($this->route),
	'method'      => 'get',
    'htmlOptions' => array('class' => 'custom'),
)); ?>

    <?php $this->widget('CategoryDropdownWidget', array('model' => $model, 'form' => $form)) ?>

    <?php echo $form->label($model,'name'); ?>
    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>

    <?php echo CHtml::submitButton('Search', array('class' => 'secondary button radius')) ?>

    <hr />

<?php  $this->endWidget(); ?>
