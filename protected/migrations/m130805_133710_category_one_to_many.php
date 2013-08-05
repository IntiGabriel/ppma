<?php

class m130805_133710_category_one_to_many extends CDbMigration
{
	public function safeUp()
	{
        $this->dropTable('category_has_entry');
        $this->addColumn('entry', 'categoryId', 'int NOT NULL DEFAULT 1');
	}

	public function safeDown()
	{
        $this->dropColumn('entry', 'categoryId');
        $this->createTable('category_has_entry', array(
            'entryId'    => 'integer NOT NULL',
            'categoryId' => 'integer NOT NULL',
            'PRIMARY KEY (entryId, categoryId)',
        ));
	}
}