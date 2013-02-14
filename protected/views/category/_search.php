<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form ActiveForm */
?>

<?php $form = $this->beginWidget('ActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

    <?php echo $form->label($model,'id'); ?>
    <?php echo $form->textField($model,'id'); ?>

    <?php echo $form->label($model,'parentId'); ?>
    <?php echo $form->textField($model,'parentId'); ?>

    <?php echo $form->label($model,'name'); ?>
    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>

    <?php echo CHtml::submitButton('Search', array('class' => 'secondary button radius')) ?>

    <hr />

<?php  $this->endWidget(); ?>
