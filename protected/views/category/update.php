<?php
/* @var $this CategoryController */
/* @var $model Category */
?>

<h2>Update Category <?php echo CHtml::encode($model->name); ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>