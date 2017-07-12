<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Object extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Admin Users CRUD
	public function index()
	{
		$crud = $this->generate_crud('objects');
		$crud->columns('id', 'name_zh', 'name_en', 'sub_category_id', 'description','expected_location_id', 'status', 'img_url');
		$crud->set_relation('sub_category_id', 'sub_categorys', 'name_en');
		$crud->set_relation('expected_location_id', 'locations', 'name_en');
		$this->unset_crud_fields('created_at');
		$crud->set_field_upload('img_url', 'assets/uploads/files');
		$this->render_crud();
	}

}