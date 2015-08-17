<?php

class m150801_105246_add_sort_field extends CDbMigration
{
	public function up()
	{
            $this->addColumn('categories', 'sort', 'int(11)');
	}

	public function down()
	{
		echo "m150801_105246_add_sort_field does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}