<?php

class m150701_043836_add_alias_url extends CDbMigration
{
	public function safeUp()
	{
            $this->addColumn('news', 'alias_url', 'varchar(255) NOT NULL');
	}

	public function down()
	{
		echo "m150701_043836_add_alias_url does not support migration down.\n";
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