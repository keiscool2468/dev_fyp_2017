<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Transaction extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Admin Users CRUD
	public function index()
	{
		$crud = $this->generate_crud('transactions');
		// $crud->columns('id', 'name_zh', 'name_en', 'status');
		$crud->set_relation('user_id_1', 'users', 'username');
		$crud->set_relation('user_id_2', 'users', 'username');
		$crud->set_relation('object_id_1', 'objects', 'name_en');	
		$crud->set_relation('object_id_2', 'objects', 'name_en');
		$crud->set_relation('expected_location_id', 'locations', 'name_en');
		$this->unset_crud_fields('created_at');
		$this->render_crud();
	}

}