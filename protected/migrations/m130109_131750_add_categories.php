<?php

class m130109_131750_add_categories extends CDbMigration
{

	public function safeUp()
	{
        $this->createTable('Category', array(
            'id'       => 'pk',
            'parentId' => 'int DEFAULT NULL',
            'name'     => 'string NOT NULL',
        ));
	}

	public function safeDown()
	{
        $this->dropTable('Category');
	}

}