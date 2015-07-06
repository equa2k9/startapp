<?php

class m150702_124449_cat_attributes_articles extends CDbMigration
{
	public function safeUp()
	{
            $this->execute(<<<SQL


CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name_uk` varchar(50) DEFAULT NULL,
  `name_ru` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `description_uk` text,
  `description_en` text,
  `description_ru` text,
  `alias_url` varchar(50) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                    
CREATE TABLE IF NOT EXISTS `articles_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `categories_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_uk` varchar(50) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                    
ALTER TABLE  `articles_pictures` ADD INDEX (  `article_id` ) ;
                    ALTER TABLE  `articles` ADD INDEX (  `category_id` ) ;
                    ALTER TABLE  `categories_attributes` ADD INDEX (  `category_id` ) ;
                    ALTER TABLE  `articles_pictures` ADD CONSTRAINT  `article_pictures` FOREIGN KEY (  `article_id` ) REFERENCES  `jazzme`.`articles` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
                    ALTER TABLE  `articles` ADD CONSTRAINT  `article_category` FOREIGN KEY (  `category_id` ) REFERENCES  `jazzme`.`categories` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
                    ALTER TABLE  `categories_attributes` ADD CONSTRAINT  `category_attribs` FOREIGN KEY (  `category_id` ) REFERENCES  `jazzme`.`categories` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
SQL
        );
	}

	public function down()
	{
		echo "m150702_124449_cat_attributes_articles does not support migration down.\n";
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