<?php

class m140424_140032_users_answers extends CDbMigration
{
	protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8';
    
	public function safeUp()
	{
        $this->createTable('users_answers', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'answer_id' => 'int(11) NOT NULL',
            'question_id' => 'int(11) NOT NULL',
            'answer' => 'int(11) NOT NULL',
        ), $this->MySqlOptions);
	}

	public function safeDown()
	{
		echo "m140424_140032_users_answers does not support migration down.\\n";
		return false;
	}
}