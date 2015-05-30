<?php

class m150530_175759_some_fix_relation extends CDbMigration
{
	public function up()
	{
            
            $this->execute(<<<SQL

ALTER TABLE  `trips_pay` DROP FOREIGN KEY  `tripspaypassenger` ;

ALTER TABLE  `trips_pay` ADD CONSTRAINT  `tripspaypassenger` FOREIGN KEY (  `trips_passengers_id` ) REFERENCES  `paratransit`.`trips_passengers` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;




SQL
			);
	}

	public function down()
	{
		echo "m150530_175759_some_fix_relation does not support migration down.\n";
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