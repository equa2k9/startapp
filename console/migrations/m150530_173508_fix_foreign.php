<?php

class m150530_173508_fix_foreign extends CDbMigration
{
	public function safeUp()
	{
        $this->execute(<<<SQL

ALTER TABLE  `trips_passengers` DROP FOREIGN KEY  `tripspassenger` ;

ALTER TABLE  `trips_passengers` ADD CONSTRAINT  `tripspassenger` FOREIGN KEY (  `trips_id` ) REFERENCES  `paratransit`.`trips` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
                
 ALTER TABLE  `trips_pay` DROP FOREIGN KEY  `tripspays` ;

ALTER TABLE  `trips_pay` ADD CONSTRAINT  `tripspays` FOREIGN KEY (  `trips_id` ) REFERENCES  `paratransit`.`trips` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
    
                ALTER TABLE  `trips_activity` DROP FOREIGN KEY  `tripsactivity` ;

ALTER TABLE  `trips_activity` ADD CONSTRAINT  `tripsactivity` FOREIGN KEY (  `trips_id` ) REFERENCES  `paratransit`.`trips` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
                
                
                ALTER TABLE `trips_activity` DROP FOREIGN KEY `tripsactivity`;
ALTER TABLE `trips_activity` ADD  CONSTRAINT `tripsactivity` FOREIGN KEY (`trips_id`) REFERENCES `paratransit`.`trips`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `trips_activity` DROP FOREIGN KEY `useractivity`;
ALTER TABLE `trips_activity` ADD  CONSTRAINT `useractivity` FOREIGN KEY (`users_id`) REFERENCES `paratransit`.`users`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `trips_activity` DROP FOREIGN KEY `tripforpassengeractivity`;
ALTER TABLE `trips_activity` ADD  CONSTRAINT `tripforpassengeractivity` FOREIGN KEY (`trips_passengers_id`) REFERENCES `paratransit`.`trips_passengers`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

                ALTER TABLE  `trips_passengers` DROP FOREIGN KEY  `tripspassenger` ;

ALTER TABLE  `trips_passengers` ADD CONSTRAINT  `tripspassenger` FOREIGN KEY (  `trips_id` ) REFERENCES  `paratransit`.`trips` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
                
                ALTER TABLE  `trips_pay` DROP FOREIGN KEY  `tripspays` ;

ALTER TABLE  `trips_pay` ADD CONSTRAINT  `tripspays` FOREIGN KEY (  `trips_id` ) REFERENCES  `paratransit`.`trips` (
`id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
                
                ALTER TABLE  `routesheet` DROP FOREIGN KEY  `status` ;

ALTER TABLE  `routesheet` ADD CONSTRAINT  `status` FOREIGN KEY (  `status_id` ) REFERENCES  `paratransit`.`routesheet_status` (
`id`
) ON DELETE NO ACTION ON UPDATE RESTRICT ;



SQL
			);
	}

	public function down()
	{
		echo "m150530_173508_fix_foreign does not support migration down.\n";
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