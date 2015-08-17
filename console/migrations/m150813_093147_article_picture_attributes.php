<?php

class m150813_093147_article_picture_attributes extends CDbMigration
{
	public function safeUp()
	{
             $this->addColumn('articles_pictures', 'mime', 'varchar (255)');
            $this->addColumn('articles_pictures', 'name', 'varchar (255)');
            $this->addColumn('articles_pictures', 'size', 'varchar (255)');
            $this->addColumn('articles_pictures', 'source', 'varchar (255)');
	}

	public function down()
	{
		echo "m150813_093147_article_picture_attributes does not support migration down.\n";
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