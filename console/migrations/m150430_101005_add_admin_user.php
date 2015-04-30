<?php

class m150430_101005_add_admin_user extends CDbMigration
{

    public function up()
    {

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
        $this->insert('users', array(
            'username' => 'dispatcher',
            'password' => '55M7tstq0ibpg',
            'password_hash' => '552fc95475e0c1.33586164',
            'role' => 'dispatcher',
            'email' => 'jek3211@gmail.com', //my email, change it to yours
            'is_activated' => 1,
            'hash_link' => NULL,
            'created_at' => time(),
            'photo' => 'dispatcher.jpg'));
        $this->insert('users', array(
            'username' => 'accountant',
            'password' => '55M7tstq0ibpg',
            'password_hash' => '552fc95475e0c1.33586164',
            'role' => 'accountant',
            'email' => 'jek3211@gmail.com', //my email, change it to yours
            'is_activated' => 1,
            'hash_link' => NULL,
            'created_at' => time(),
            'photo' => 'accountant.jpg'));
        $this->insert('users', array(
            'username' => 'admin_reader',
            'password' => '55M7tstq0ibpg',
            'password_hash' => '552fc95475e0c1.33586164',
            'role' => 'reader',
            'email' => 'jek3211@gmail.com', //my email, change it to yours
            'is_activated' => 1,
            'hash_link' => NULL,
            'created_at' => time(),
            'photo' => 'reader.jpg'));
    }

    public function down()
    {
        echo "m150430_101005_add_admin_user does not support migration down.\n";
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
