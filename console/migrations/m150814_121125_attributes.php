<?php

class m150814_121125_attributes extends CDbMigration
{
	public function safeUp()
	{
            $this->addColumn('articles', 'specification_uk', 'text');
            $this->addColumn('articles', 'specification_ru', 'text');
            $this->addColumn('articles', 'specification_en', 'text');
            $this->addColumn('articles', 'colors_uk', 'text');
            $this->addColumn('articles', 'colors_ru', 'text');
            $this->addColumn('articles', 'colors_en', 'text');
            $this->addColumn('articles', 'sizes_uk', 'text');
            $this->addColumn('articles', 'sizes_ru', 'text');
            $this->addColumn('articles', 'sizes_en', 'text');
	}

	public function down()
	{
		echo "m150814_121125_attributes does not support migration down.\n";
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