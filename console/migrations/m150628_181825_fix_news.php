<?php

class m150628_181825_fix_news extends CDbMigration
{

    public function safeUp()
    {
        $this->execute(<<<SQL

ALTER TABLE  `news` CHANGE  `text_ru`  `text_ru` TEXT NULL DEFAULT NULL ;
                    ALTER TABLE  `news` CHANGE  `text_en`  `text_en` TEXT NULL DEFAULT NULL ;


SQL
        );
    }

    public function down()
    {
        echo "m150628_181825_fix_news does not support migration down.\n";
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
