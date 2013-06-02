<?php

class m130602_162536_default_category extends CDbMigration
{

	public function safeUp()
	{
        $model = new Category();
        $model->name = 'Main Category';
        $model->save();
	}

	public function safeDown()
	{
        Yii::app()->db->createCommand()->truncateTable( Category::model()->tableName() );
	}

}