<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('object_model');
		$this->load->model('sub_category_model');
		$this->load->model('location_model');
		$this->load->model('Usr_model');
        $this->load->helper('url_helper');
        $this->load->helper("form");
    }
	public function index()
	{	
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();
		if(empty($this->mUser))
			$this->render('home', 'full_width');
		else
		{	
			$currUser = $this->db->get_where('users_categorys',array('user_id' => $this->mUser->id))->result_array();
			if(!empty($currUser)){
				$this->mViewData = array(
					'objects'  		=> $this->object_model->with('sub_category')->with('location')->with('user')->get_all(),
					'sub_cates'		=> (array)$this->sub_category_model->with('category')->get_all(),
					'locations'		=> $this->location_model->with('location')->get_all(),
					'user'			=> $this->mUser->username,
				);
				// $this->mViewData = array(
				// 	'objects'  		=> $this->object_model->with('sub_category')->with('location')->with('user')->get_all(),
				// 	'sub_cates'		=> $this->sub_category_model->with('category')->get_all(),
				// 	'locations'		=> $this->location_model->with('location')->get_all(),
				// 	'user'			=> $this->mUser->username,
				// );
				$this->render('object', 'full_width');
			} 
			else {
				$this->mViewData = array(
					'categorys'  	=> $this->db->get('categorys')->result_array(),
					'form'			=> $form
				);
				$this->render('userQuestion', 'full_width');
			}
		}
	}
}
