<?php

class m140627_160155_set_passnumber_not_required extends CDbMigration
{
	public function safeUp()
	{
		$this->update('profiles_fields', array(
                        'required'=>0,
                        ), 'varname=:id', array(':id'=>'pass_number'));

        $this->alterColumn('profiles', 'pass_number', 'VARCHAR( 255 ) NULL DEFAULT NULL');
	}

	public function safeDown()
	{
		echo "m140627_160155_set_passnumber_not_required does not support migration down.\\n";
		return false;
	}
}