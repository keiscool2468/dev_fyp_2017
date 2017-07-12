<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Object extends MY_Controller {
	/**
	 * Login page and submission
	 */public function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        $this->load->model('object_model');
		$this->load->model('sub_category_model');
		$this->load->model('location_model');
        $this->load->helper('url_helper');
    }
	public function index()
	{	
		if(empty($this->mUser))
			redirect('login');
		else
		{
			$myObjects = $this->db->get_where('objects',array('user_id' => $this->mUser->id))->result_array();
			$this->mViewData = array(
				'objects'  		=> $this->object_model->with('sub_category')->with('location')->get_all(),
				'user'			=> $this->mUser,
				'sub_cates'		=> $this->sub_category_model->with('category')->get_all(),
				'locations'		=> $this->location_model->with('location')->get_all()
			);
			$this->render('myObject', 'full_width');
		}
	}
	public function addObject()
	{
		$config['upload_path']          = '../assets/uploads/objects';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
		$this->upload->do_upload('img_url');
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{	
			// print_r($_FILES['img_url']['name']);exit;
            $object = array(
				'name_zh'							=> $this->input->post('name_zh'),
				'name_en'							=> $this->input->post('name_en'),
				'sub_category_id'					=> $this->input->post('sub_cate'),
				'description'						=> $this->input->post('description'),
				'img_url'							=> $_FILES['img_url']['name'],
				'user_id'							=> $this->mUser->id,
				'expected_location_id'				=> $this->input->post('location'),
				'status'							=> 'active'
			);
		}
		$this->db->insert('objects', $object);
		redirect('home');
	}
}