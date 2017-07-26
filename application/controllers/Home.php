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
			$this->db->where('point >', 0);
			$this->db->order_by("point", "desc");
			$currUserCates = $this->db->get_where('users_categorys',array('user_id' => $this->mUser->id))->result_array();
			$currUserBehavs = $this->db->get_where('user_behaviors',array('user_id' => $this->mUser->id))->result_array();
			if((!empty($currUserCates))&&(!empty($currUserBehavs))){
				$userCates = array();
				foreach ($currUserCates as $currUserCate){
					$this->db->where_in('category_id', $currUserCate['category_id']);
					$filtedCates = $this->db->get('sub_categorys')->result_array();
					foreach ($filtedCates as $filtedCate) {
						array_push($userCates, $filtedCate);
					}
				}
				// $this->db->or_where_in('category_id', $userCates);
				// $filtedCates = $this->db->get('sub_categorys')->result_array();
				$filtedSubCates = array();
				foreach ($userCates as $userCate){
					array_push($filtedSubCates, $userCate['id']);
				}
				$this->db->limit(40);
				$this->db->where('status', 'active');
				$objects = array();
				foreach ($filtedSubCates as $filtedSubCate) {
					$this->db->where_in('sub_category_id', $filtedSubCate);
					$objs = $this->object_model->with('sub_category')->with('location')->with('user')->get_all();
					foreach ($objs as $obj) {
						array_push($objects, $obj);
					}
				}
				if(sizeof($objects) < 40){
					$this->db->limit(40-sizeof($objects));
					// $this->db->or_where_in('expected_location_id', $currUserBehavs[0]['location_id']);
					$this->db->or_where_not_in('sub_category_id', $filtedSubCates);
					$this->db->where_in('status', 'active');
					$this->db->order_by("id", "random");
					$object2s = (array) $this->object_model->with('sub_category')->with('location')->with('user')->get_all();
					$objects = $this->render_order($objects, $currUserCates, $currUserBehavs[0], $object2s);
				}else{
					$objects = $this->render_order($objects, $currUserCates, $currUserBehavs[0]);
				}
				$this->mViewData = array(
					'objects'  		=> $objects,
					'sub_cates'		=> $this->sub_category_model->with('category')->get_all(),
					'locations'		=> $this->location_model->with('location')->get_all(),
					'user'			=> $this->mUser->username,
					// 'object2s'		=> $object2s,
					'behaviors'		=> $currUserBehavs[0],
					'categorys'		=> $filtedSubCates,
				);
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
