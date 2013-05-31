<?php

class m130214_165658_categories_to_entry extends CDbMigration
{

	public function safeUp()
	{
        $this->createTable('category_has_entry', array(
            'entryId'    => 'integer NOT NULL',
            'categoryId' => 'integer NOT NULL',
            'PRIMARY KEY (entryId, categoryId)',
        ));
	}

	public function safeDown()
	{
        $this->dropTable('category_has_entry');
	}

}