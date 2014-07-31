<?php

class m140307_122940_tables extends CDbMigration
{
    protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8';

    public function safeUp()
    {
        $this->createTable('questions', array(
            'question_id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'level_id' => 'int(10) unsigned NOT NULL',
            'iteration_count' => 'int(10) unsigned NOT NULL',
            'answer' => 'varchar(255) NOT NULL',
            'text' => 'text NOT NULL',
            'date_added' => 'datetime NOT NULL',
            'expired_date' => 'datetime DEFAULT NULL',
            'result' => 'varchar(255) NOT NULL',
        ), $this->MySqlOptions);

        $this->createTable('levels', array(
            'level_id' => 'pk',
            'parent_id' => 'int(10) unsigned NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'date_added' => 'datetime NOT NULL',
        ), $this->MySqlOptions);

        $this->createTable('answers', array(
            'answer_id' => 'pk',
            'question_id' => 'int(10) unsigned NOT NULL',
            'iteration_number' => 'int(10) unsigned NOT NULL',
            'answers_array' => 'text NOT NULL',
            'date_last_update' => 'datetime NOT NULL',
        ), $this->MySqlOptions);

        $this->createTable('locations', array(
            'location_id' => 'pk',
            'level_id' => 'int(10) unsigned NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'date_added' => 'datetime NOT NULL',
        ), $this->MySqlOptions);

        $this->createTable('comments', array(
            'comment_id' => 'pk',
            'question_id' => 'int(10) unsigned NOT NULL',
            'user_id' => 'int(11) unsigned NOT NULL',
            'text' => 'text NOT NULL',
            'date_added' => 'datetime NOT NULL',
        ), $this->MySqlOptions);

        $this->createTable('delegates', array(
            'id' => 'pk',
            'user_id' => 'int(11) unsigned NOT NULL',
            'delegate_id' => 'int(10) unsigned NOT NULL',
            'level_id' => 'int(10) unsigned NOT NULL',
            'date_added' => 'datetime NOT NULL',
        ), $this->MySqlOptions);

        $this->createTable('linking', array(
            'id' => 'pk',
            'user_id' => 'int(11) unsigned NOT NULL',
            'level_id' => 'int(10) unsigned NOT NULL',
            'location_id' => 'int(10) unsigned NOT NULL',
        ), $this->MySqlOptions);



    }

    public function safeDown()
    {
        $this->dropTable('levels');
        $this->dropTable('questions');
        $this->dropTable('answers');
        $this->dropTable('locations');
        $this->dropTable('comments');
        $this->dropTable('delegates');
        $this->dropTable('linking');
    }
}