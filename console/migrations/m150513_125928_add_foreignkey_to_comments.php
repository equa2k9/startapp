<?php

class m150513_125928_add_foreignkey_to_comments extends CDbMigration
{
	public function safeUp()
	{
        $this->addForeignKey('leaved_comments','drivers_comments','leave_comment_id','users','id','CASCADE','RESTRICT');
	}

	public function down()
	{
		echo "m150513_125928_add_foreignkey_to_comments does not support migration down.\n";
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