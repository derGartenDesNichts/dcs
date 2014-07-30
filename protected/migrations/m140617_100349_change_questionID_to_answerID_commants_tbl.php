<?php

class m140617_100349_change_questionID_to_answerID_commants_tbl extends CDbMigration
{
	public function safeUp()
	{
		$this->renameColumn('comments', 'question_id', 'answer_id');
	}

	public function safeDown()
	{
		echo "m140617_100349_change_questionID_to_answerID_commants_tbl does not support migration down.\\n";
		return false;
	}
}