<?php

class m150709_152249_fix_slider extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL

ALTER TABLE  `slider` DROP FOREIGN KEY  `article` ;
                    ALTER TABLE  `slider` ADD CONSTRAINT  `article` FOREIGN KEY (  `id` ) REFERENCES  `jazzme`.`articles` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
                    ALTER TABLE  `slider` DROP  `articles_id` ;


SQL
        );
	}

	public function down()
	{
		echo "m150709_152249_fix_slider does not support migration down.\n";
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