<?php

class m150513_124203_comment_driver extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('drivers_comments',array(
           'id'=>'pk',
            'users_id'=>'int(11) NOT NULL',
            'leave_comment_id'=>'int(11) NOT NULL',
            'message'=>'text',
            'created_at'=>'int(11) NOT NULL'
        ));
        $this->addForeignKey('my_comments','drivers_comments','users_id','users','id','CASCADE','RESTRICT');
	}

	public function safeDown()
	{
        $this->dropTable('drivers_comments');
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