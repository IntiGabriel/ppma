<?php /* @var Category[] $models */ ?>
<?php /* @var bool $renderContainer */ ?>

<?php if ($renderContainer) : ?>

    <div class="row">
        <div class="ten columns category-box">

<?php endif; ?>


            <ul>
                <?php foreach ($models as $index => $model) : ?>
                    <li>
                        <label for="<?php echo CHtml::activeId($model, "[$index]id"); ?>">
                            <?php echo CHtml::activeCheckBox($model, "[$index]id", array('class' => 'hide')); ?>
                            <span class="custom checkbox"></span> <?php echo $model->name ?>
                        </label>

                        <?php if (count($model->childs) > 0) : ?>
                            <?php $this->owner->widget('ext.CategoryWidget.CategoryWidget', array(
                                'models'          => $model->childs,
                                'renderContainer' => false,
                            )); ?>
                        <?php endif; ?>

                    </li>
                <?php endforeach; ?>
            </ul>


<?php if ($renderContainer) : ?>

        </div>
    </div>

<?php endif; ?>
