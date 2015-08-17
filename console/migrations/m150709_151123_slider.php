<?php

class m150709_151123_slider extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) NOT NULL,
  `articles_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                    ALTER TABLE  `slider` ADD INDEX (  `articles_id` ) ;
ALTER TABLE  `slider` ADD CONSTRAINT  `article` FOREIGN KEY (  `articles_id` ) REFERENCES  `jazzme`.`articles` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;


SQL
        );
	}

	public function down()
	{
		echo "m150709_151123_slider does not support migration down.\n";
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