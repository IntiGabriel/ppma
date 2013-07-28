<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $form=$this->beginWidget('ActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->label($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 255)); ?>

    <?php echo $form->label($model, 'url'); ?>
    <?php echo $form->textField($model, 'url', array('size' => 50, 'maxlength' => 255)); ?>

    <?php echo $form->label($model, 'username'); ?>
    <?php echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 255)); ?>

    <?php echo $form->label($model, 'tagList'); ?>
    <?php echo $form->textField($model, 'tagList', array('size' => 50)); ?>

    <?php echo $form->label($model, 'comment'); ?>
    <?php echo $form->textField($model, 'comment', array('size' => 50)); ?>

    <?php echo TbHtml::submitButton('<i class="icon-search icon-white"></i> Search', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)) ?>

    <hr />

<?php $this->endWidget(); ?>
