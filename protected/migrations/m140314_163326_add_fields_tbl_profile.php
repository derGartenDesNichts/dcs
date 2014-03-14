<?php

class m140314_163326_add_fields_tbl_profile extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('profiles','second_name','varchar(255) not null');
        $this->addColumn('profiles','birthday','date not null');
        $this->addColumn('profiles','pass_number','varchar(255) not null');
    }

	public function safeDown()
	{
		echo "m140314_163326_add_fields_tbl_profile does not support migration down.\\n";
		return false;
	}
}