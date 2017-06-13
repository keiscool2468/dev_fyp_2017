<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Location extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Admin Users CRUD
	public function index()
	{
		$crud = $this->generate_crud('locations');
		$crud->columns('id', 'name_zh', 'name_en','img_url', 'status');
		
		$crud->set_field_upload('img_url', 'assets/uploads/files');
		$this->unset_crud_fields('created_at');
		$this->render_crud();
	}

}