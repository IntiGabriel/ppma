<?php
/* @var Category $model */
/* @var CActiveForm $form */

/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.foundation.forms.js');

?>

<?php $form = $this->beginWidget('ActiveForm', array(
    'id'    => 'category-form',
    'focus' => array($model, 'name'),
    'htmlOptions' => array('class' => 'custom'),
)); ?>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <?php echo $form->labelEx($model, 'parentId'); ?>
    <?php echo $form->dropDownList($model, 'parentId',
        CHtml::listData(Category::model()->orderByNameAsc()->without($model->id)->findAll(), 'id', 'name'),
        array('empty' => Category::NO_PARENT_STRING, 'class' => 'hide')
    ); ?>
    <div class="custom dropdown">
        <a href="#" class="current">
            <?php if ($model->parentId == null) : ?>
                <?php echo Category::NO_PARENT_STRING; ?>
            <?php else : ?>
                <?php $parent = Category::model()->findByPk($model->parentId) ?>
                <?php if ($parent instanceof Category) : ?>
                    <?php echo CHtml::encode($parent->name) ?>
                <?php else : ?>
                    Error: Parent category does not exist
                <?php endif; ?>
            <?php endif; ?>
        </a>
        <a href="#" class="custom selector"></a>
        <ul>
            <li><?php echo Category::NO_PARENT_STRING; ?></li>
            <?php foreach (Category::model()->orderByNameAsc()->without($model->id)->findAll() as $category) : ?>
                <li><?php echo $category->name ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php echo $form->error($model, 'parentId'); ?>

    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>

    <?php echo CHtml::submitButton('Save', array('class' => 'button radius'))?>

<?php $this->endWidget(); ?>