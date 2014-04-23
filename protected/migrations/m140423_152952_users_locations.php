<?php

class m140423_152952_users_locations extends CDbMigration
{
    protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8';
    
	public function safeUp()
	{
        $this->createTable('users_locations', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'location_id' => 'int(11) NOT NULL',
        ), $this->MySqlOptions);
	}

	public function safeDown()
	{
		echo "m140423_152952_users_locations does not support migration down.\\n";
		return false;
	}
}