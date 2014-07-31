<?php

class m140620_144627_answer_update extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('answers', 'likes', 'int(11)');
        $this->addColumn('answers', 'dislikes', 'int(11)');
        $this->addColumn('answers', 'revision', 'int(11)');
	}

	public function safeDown()
	{
		echo "m140620_144627_answer_update does not support migration down.\\n";
		return false;
	}
}