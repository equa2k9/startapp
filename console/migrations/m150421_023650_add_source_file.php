<?php

class m150421_023650_add_source_file extends CDbMigration
{
	public function up()
	{
            $this->addColumn('drivers_files', 'source', 'varchar (255)');
	}

	public function down()
	{
		echo "m150421_023650_add_source_file does not support migration down.\n";
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