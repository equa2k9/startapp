<?php

class m150628_181306_add_multilanguage extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL

ALTER TABLE  `news` CHANGE  `title`  `title_ua` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;
                    ALTER TABLE  `news` ADD  `title_ru` VARCHAR( 255 ) NULL ,
ADD  `title_en` VARCHAR( 255 ) NULL ;
                    ALTER TABLE  `news` CHANGE  `text`  `text_ua` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;
                    ALTER TABLE  `news` ADD  `text_ru` INT NULL ,
ADD  `text_en` INT NULL ;


SQL
        );
            
	}

	public function down()
	{
		echo "m150628_181306_add_multilanguage does not support migration down.\n";
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