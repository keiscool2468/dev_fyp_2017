<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        $this->load->helper('url_helper');
    }
    
	public function index()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
            $username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$identity = empty($username) ? $email : $username;
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
                'company'       => $this->input->post('company'),
                'phone'         => $this->input->post('phone'),
			);
            $groups = ['1'];
			$user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);			
			if ($user_id)
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);

				// directly activate user
				$this->ion_auth->activate($user_id);
                redirect('login');
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}

		}
		
		$this->mViewData['form'] = $form;
		$this->render('register', 'empty');
	}

	public function comfirmInterest()
	{
		$categorys = $this->db->get('categorys')->result_array();
		foreach ($categorys as $category){
			if(empty($this->input->post($category['id'])))
			{
				$users_category = array(
					'user_id'		=> $this->mUser->id,
					'category_id'	=> $category['id'],
					'point'			=> 0,
				);
			} else {
				$users_category = array(
					'user_id'		=> $this->mUser->id,
					'category_id'	=> $category['id'],
					'point'			=> 10,
				);
			}
			$this->db->insert('users_categorys', $users_category);
		}
		$location = 100 - $this->input->post('decision');
		$user_behavior = array(
			'user_id'		=> $this->mUser->id,
			'interest'		=> $this->input->post('decision'),
			'location'		=> $location,
			'location_id'	=> $this->input->post('location_id')
		);
		$this->db->insert('user_behaviors', $user_behavior);
		redirect('home');
	}
}