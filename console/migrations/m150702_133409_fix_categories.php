<?php

class m150702_133409_fix_categories extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL

ALTER TABLE  `categories` CHANGE  `alias`  `alias_url` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
                   


SQL
        );
	}

	public function down()
	{
		echo "m150702_133409_fix_categories does not support migration down.\n";
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