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
			$currUser2 = $this->db->get_where('user_behaviors',array('user_id' => $this->mUser->id))->result_array();
			if((!empty($currUser))&&(!empty($currUser2))){
				$this->db->limit(20);
				// $this->db->where_in('sub_category', 1); 
				$this->db->order_by('id', 'RANDOM');
				$objects = (array) $this->object_model->with('sub_category')->with('location')->with('user')->get_all();
				// $user_cate = $this->db->get('users_categorys')->result_array();
				// $user_behav = $this->db->get_where('user_behaviors', array('user_id' => $this->mUser->id))->result_array()[0];
				// $objectArr = $this->render_order($objects, $user_cate, $user_behav);
				$this->mViewData = array(
					'objects'  		=> $objects,
					'sub_cates'		=> $this->sub_category_model->with('category')->get_all(),
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
					'form'			=> $form,
					'locations'		=> $this->db->get('locations')->result_array()
				);
				$this->render('userQuestion', 'full_width');
			}
		}
	}
}
