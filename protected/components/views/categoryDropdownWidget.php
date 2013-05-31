<?php
/* @var CategoryDropdownWidget $this */
/* @var Category $model */
/* @var CActiveForm $form */
/* @var string $attribute */

/* @var CClientScript $clientScript */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.foundation.forms.js');

?>


<?php /* Label and Dropdown */ ?>
<?php echo $form->labelEx($model, $attribute); ?>
<?php echo $form->dropDownList($model, $attribute,
    CHtml::listData(Category::model()->orderByNameAsc()->without($model->id)->findAll(), 'id', 'name'),
    array('empty' => Category::NO_PARENT_STRING, 'class' => 'hide')
); ?>

<?php /* Foundations Dropdown */ ?>
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


<?php /* Error message */ ?>
<?php echo $form->error($model, 'parentId'); ?>

