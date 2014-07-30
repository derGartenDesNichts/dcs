<?php

class m140323_175355_addition_fields extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('questions','title','varchar(255) not null');
	}

	public function safeDown()
	{
		echo "m140323_175355_addition_fields does not support migration down.\\n";
		return false;
	}
}