<?php

class m150702_104726_change_ua_to_uk extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL

ALTER TABLE  `news` CHANGE  `title_ua`  `title_uk` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;
                    ALTER TABLE  `news` CHANGE  `text_ua`  `text_uk` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;


SQL
        );
	}

	public function down()
	{
		echo "m150702_104726_change_ua_to_uk does not support migration down.\n";
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