<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_audit_table extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'start_date' => array(
				'type' => 'DATE',
			),
			'end_date' => array(
				'type' => 'DATE',
			),
			'business_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
			'supervisor_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field('CONSTRAINT business_id_fk FOREIGN KEY (business_id) REFERENCES small_business_entity(id) ON DELETE CASCADE ON UPDATE CASCADE');
		$this->dbforge->add_field('CONSTRAINT supervisor_id_fk FOREIGN KEY (supervisor_id) REFERENCES supervisor(id) ON DELETE CASCADE ON UPDATE CASCADE');
		$this->dbforge->create_table('audit');
	}

	public function down()
	{
		$this->dbforge->drop_table('audit');
	}
}
