<?php

class m150616_121159_common extends CDbMigration
{
    public function safeUp()
    {
        $this->execute(<<<SQL

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `hash_link` varchar(100) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;



SQL
        );


        $this->insert('users', array(
            'username' => 'administrator',
            'password' => '55M7tstq0ibpg',
            'password_hash' => '552fc95475e0c1.33586164',
            'role' => 'administrator',
            'email' => 'jek3211@gmail.com', //my email, change it to yours
            'is_activated' => 1,
            'hash_link' => NULL,
            'created_at' => time(),
            'photo' => 'admin.jpg'));

    }


	public function down()
	{
		echo "m150616_121159_common does not support migration down.\n";
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