<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Category extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Admin Users CRUD
	public function index()
	{
		$crud = $this->generate_crud('categorys');
		$crud->columns('id', 'name_zh', 'name_en', 'status');
		$this->unset_crud_fields('created_at');
		$this->render_crud();
	}

	public function sub_category()
	{
		$crud = $this->generate_crud('sub_categorys');
		$crud->columns('id', 'name_zh', 'name_en','category_id','img_url', 'status');
		$crud->set_relation('category_id', 'categorys', 'name_en');	
		$this->unset_crud_fields('created_at');
		$crud->set_field_upload('img_url', 'assets/uploads/objects');
		$this->render_crud();
	}

	public function user_sub_category($user_id)
	{
		$crud = $this->generate_crud('users_categorys');
		$crud->columns('category_id', 'point');
		$this->unset_crud_fields('user_id');
		$crud->set_relation('category_id', 'categorys', 'name_en');	
		$crud->where('user_id', $user_id);
		$this->render_crud();
	}
	
	public function user_behaviors($user_id)
	{
		$crud = $this->generate_crud('user_behaviors');
		$crud->columns('interest', 'location', 'location_id');
		$crud->set_relation('location_id', 'locations', 'name_en');
		$this->unset_crud_fields('user_id');
		$crud->where('user_id', $user_id);
		$this->render_crud();
	}

}