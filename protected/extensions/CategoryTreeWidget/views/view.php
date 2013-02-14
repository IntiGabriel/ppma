<?php /* @var CActiveRecord $model */ ?>
<?php /* @var string $attribute */ ?>
<?php /* @var Category[] $categories */ ?>
<?php /* @var bool $renderContainer */ ?>

<?php if ($renderContainer) : ?>

    <div class="row">
        <div class="twelve columns">
            <div class="tree-box">

<?php endif; ?>

                <ul>
                    <?php foreach($categories as $index => $category) : ?>
                        <li>
                            <?php /* @var Category $category */ ?>
                            <?php $id = sprintf('%s_%s', CHtml::activeId($model, $attribute), $category->id); ?>
                            <?php $checked = in_array($category->id, $model->categoryIds) ?>

                            <label for="<?php echo $id ?>">
                                <?php echo CHtml::activeCheckBox($model, sprintf('%s[]', $attribute), array(
                                    'id'      => $id,
                                    'class'   => 'hide',
                                    'value'   => $category->id,
                                    'checked' => $checked,
                                )); ?>
                                <span class="custom <?php echo ($checked ? 'checked' : '') ?> checkbox"></span> <?php echo $category->name ?>
                            </label>

                            <?php if (count($category->childs) > 0) : ?>
                                <?php $this->owner->widget('ext.CategoryTreeWidget.CategoryTreeWidget', array(
                                    'model'           => $model,
                                    'attribute'       => $attribute,
                                    'categories'      => $category->childs,
                                    'renderContainer' => false,
                                )); ?>
                            <?php endif; ?>

                        </li>
                    <?php endforeach; ?>
                </ul>

<?php if ($renderContainer) : ?>
            </div>
        </div>
    </div>

<?php endif; ?>
