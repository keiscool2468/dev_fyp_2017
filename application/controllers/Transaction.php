<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Transaction extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_model');
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
				'transactions'  => $this->transaction_model->with('user_1')->with('user_2')->with('object_1')->with('object_2')->with('location')->get_all(),
				'objects'		=> $myObjects,
				'user'			=> $this->mUser
			);
			$this->render('myTransaction', 'full_width');
		}
	}
	public function addTransaction()
	{
		$myObjects = $this->db->get_where('objects',array('user_id' => $this->mUser->id))->result_array();
			// print_r($myObjects);exit;
			$transaction = array(
				'user_id_1'					=> $this->mUser->id,
				'user_id_2'					=> $this->input->post('user_id'),
				'object_id_2'				=> $this->input->post('object_id'),
				'expected_location_id'		=> $this->input->post('location'),
			);
			$this->db->insert('transactions', $transaction);
			redirect('home');
	}
	public function selectMine()
	{
		$transaction = array(
			'object_id_1'	=> $this->input->post('object_id'),
		);
		$this->db->where('id', $this->input->post('transaction_id'));
		$this->db->update('transactions',$transaction);
		redirect('transaction');
	}
	public function comfirmCancel()
	{
		if(!$this->input->post('boolean'))
		{
			$transaction = array(
				'status'	=> 'inactive',
			);
			$this->db->where('id', $this->input->post('transaction_id'));
			$this->db->update('transactions',$transaction);
		} else {
			//update transaction status
			$transaction = array(
				'status'	=> 'finished',
			);
			$this->db->where('id', $this->input->post('transaction_id'));
			$this->db->update('transactions',$transaction);

			//update firtst objects status
			$object_1 = array(
				'status'	=> 'inactive',
			);
			$this->db->where('id', $this->input->post('object_id_1'));
			$this->db->update('objects',$object_1);

			//update second objects status
			$object_2 = array(
				'status'	=> 'inactive',
			);
			$this->db->where('id', $this->input->post('object_id_2'));
			$this->db->update('objects',$object_2);

			$this->mViewData = array(
				'boolean'  	=> $this->input->post('boolean'),
			);
		}
		$this->mViewData = array(
			'boolean'  	=> $this->input->post('boolean'),
		);
		$this->render('afterQuestion', 'full_width');
	}
	public function feedback()
	{	
		$location = empty($this->input->post('location'));
		$category = empty($this->input->post('category'));
		if((!empty($this->input->post('category')))&&(!empty($this->input->post('location'))))
		{
			$loca = 'loca';
		} elseif((!empty($this->input->post('category')))&&(empty($this->input->post('location')))) {
			$loca = 'ca';
		} elseif((empty($this->input->post('category')))&&(!empty($this->input->post('location')))) {
			$loca = 'lo';
		} else {
			$loca = '';
		}
		$user_behavior = $this->db->get_where('user_behaviors',array('user_id' => $this->mUser->id))->result_array()[0];
		
		switch ($loca) {
			case 'loca':
				redirect('home');
				break;
			
			case 'ca':
				if($user_behavior['interest'] < 100)
				{
					$curr_behavior = array(
						'interest' 	=> $user_behavior['interest']+5,
						'location' 	=> $user_behavior['location']-5
					);
					$this->db->where('id', $user_behavior['id']);
					$this->db->update('user_behaviors',$curr_behavior);
				}
					redirect('home');
				break;

			case 'lo':
				if($user_behavior['location'] < 100)
				{
					$curr_behavior = array(
						'interest' 	=> $user_behavior['interest']-5,
						'location' 	=> $user_behavior['location']+5
					);
					$this->db->where('id', $user_behavior['id']);
					$this->db->update('user_behaviors',$curr_behavior);
				}
				redirect('home');
				break;

			case '':
				redirect('home');
				break;
		}
	}
}