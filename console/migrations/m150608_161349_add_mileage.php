<?php

class m150608_161349_add_mileage extends CDbMigration
{
	public function up()
	{
        $this->addColumn('trips_passengers','mileage','int(11)');
	}

	public function down()
	{
		echo "m150608_161349_add_mileage does not support migration down.\n";
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