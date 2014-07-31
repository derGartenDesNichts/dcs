<?php

class m140506_083026_messages_tbl extends CDbMigration
{
    protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8';

    public function safeUp()
    {
        $this->createTable('messages', array(
            'id' => 'pk',
            'user_from' => 'int(11) NOT NULL',
            'user_to' => 'int(11) NOT NULL',
            'text' => 'text',
            'created' => 'datetime',
            'is_read'=> 'int(8) DEFAULT 0',
        ), $this->MySqlOptions);
    }

	public function safeDown()
	{
		echo "m140506_083026_messages_tbl does not support migration down.\\n";
		return false;
	}
}