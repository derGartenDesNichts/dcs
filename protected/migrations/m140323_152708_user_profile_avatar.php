<?php

class m140323_152708_user_profile_avatar extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('profiles_fields',array(
            'varname'=>'avatar',
            'title'=>'Photo',
            'field_type'=>'VARCHAR',
            'field_size'=>255,
            'field_size_min'=>0,
            'required'=>0,
            'error_message'=>'',
            'position'=>6,
            'visible'=>0
        ));

        $this->addColumn('profiles','avatar','varchar(255) not null');
	}

	public function safeDown()
	{
		echo "m140323_152708_user_profile_avatar does not support migration down.\\n";
		return false;
	}
}