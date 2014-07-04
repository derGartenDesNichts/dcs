<?php

class m140704_152948_location_name_for_questions extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('questions', 'location_name', 'varchar(255)');
	}

	public function safeDown()
	{
		echo "m140704_152948_location_name_for_questions does not support migration down.\\n";
		return false;
	}
}