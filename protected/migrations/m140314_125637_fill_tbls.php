<?php

class m140314_125637_fill_tbls extends CDbMigration
{
	public function safeUp()
	{
        $this->insert('levels', array(
            'parent_id'=>0,
            'description'=>'country',
            'date_added'=>new CDbExpression('NOW()')
            ));
        $this->insert('levels',array(
                'parent_id'=>1,
                'description'=>'district',
                'date_added'=>new CDbExpression('NOW()')
            ));
        $this->insert('levels',array(
                'parent_id'=>2,
                'description'=>'city',
                'date_added'=>new CDbExpression('NOW()')
            ));
        $this->insert('levels',array(
                'parent_id'=>3,
                'description'=>'house',
                'date_added'=>new CDbExpression('NOW()')
        ));

        $this->update('profiles_fields', array(
            'required'=>1,
        ), 'id=1 OR id=2');

        $this->insert('profiles_fields',array(
                'varname'=>'second_name',
                'title'=>'Second Name',
                'field_type'=>'VARCHAR',
                'field_size'=>255,
                'field_size_min'=>3,
                'required'=>1,
                'error_message'=>'Incorrect First Name (length between 3 and 50 characters).',
                'position'=>3,
                'visible'=>3
            ));
        $this->insert('profiles_fields',array(
                'varname'=>'birthday',
                'title'=>'Birthday',
                'field_type'=>'DATE',
                'field_size'=>0,
                'required'=>1,
                'widget'=>'UWjuidate',
                'position'=>4,
                'visible'=>3
            ));
        $this->insert('profiles_fields', array(
                'varname'=>'pass_number',
                'title'=>'Pass Number',
                'field_type'=>'VARCHAR',
                'field_size'=>8,
                'field_size_min'=>8,
                'required'=>1,
                'error_message'=>'Invalid Pass Number',
                'position'=>5,
                'visible'=>3
            ));

	}

	public function safeDown()
	{
		echo "m140314_125637_fill_tbls does not support migration down.\\n";
		return false;
	}
}