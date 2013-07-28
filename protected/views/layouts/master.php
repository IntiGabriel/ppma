<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" />
        <?php Yii::app()->bootstrap->register(); ?>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css">
        <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
    	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>

    <body>

        <?php echo $content; ?>

    </body>
</html>