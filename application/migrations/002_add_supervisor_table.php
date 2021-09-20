<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_supervisor_table extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('supervisor');
	}

	public function down()
	{
		$this->dbforge->drop_table('supervisor');
	}
}
