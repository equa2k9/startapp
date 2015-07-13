<?php

class m150709_104634_fix_some_tables extends CDbMigration
{
	public function safeUp()
	{
            $this->addColumn('articles', 'price', 'float');
            $this->addColumn('articles', 'currency', 'int(1)');
	}

	public function down()
	{
		echo "m150709_104634_fix_some_tables does not support migration down.\n";
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