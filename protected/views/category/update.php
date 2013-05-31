<?php
/* @var $this CategoryController */
/* @var $model Category */
?>

<h1>Update Category <?php echo CHtml::encode($model->name); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>