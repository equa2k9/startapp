<?php

class m150421_021719_add_type_file extends CDbMigration
{
	public function up()
	{
            $this->addColumn('drivers_files', 'mime', 'varchar (255)');
            $this->addColumn('drivers_files', 'name', 'varchar (255)');
            $this->addColumn('drivers_files', 'size', 'varchar (255)');
	}

	public function down()
	{
		echo "m150421_021719_add_type_file does not support migration down.\n";
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