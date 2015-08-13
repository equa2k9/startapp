<?php

class m150702_115309_add_categories_table extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_uk` varchar(50) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


SQL
        );
	}

	public function down()
	{
		echo "m150702_115309_add_categories_table does not support migration down.\n";
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