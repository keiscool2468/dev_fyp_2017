<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Register extends MY_Controller {

	/**
	 * Login page and submission
	 */public function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        $this->load->helper('url_helper');
    }
    // public function create()
	// {
	// 	$form = $this->form_builder->create_form();

	// 	if ($form->validate())
	// 	{
	// 		// passed validation
	// 		$username = $this->input->post('username');
	// 		$email = $this->input->post('email');
	// 		$password = $this->input->post('password');
	// 		$identity = empty($username) ? $email : $username;
	// 		$additional_data = array(
	// 			'first_name'	=> $this->input->post('first_name'),
	// 			'last_name'		=> $this->input->post('last_name'),
	// 		);
	// 		$groups = $this->input->post('groups');

	// 		// [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
	// 		$this->ion_auth_model->tables = array(
	// 			'users'				=> 'users',
	// 			'groups'			=> 'groups',
	// 			'users_groups'		=> 'users_groups',
	// 			'login_attempts'	=> 'login_attempts',
	// 		);

	// 		// proceed to create user
	// 		$user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);			
	// 		if ($user_id)
	// 		{
	// 			// success
	// 			$messages = $this->ion_auth->messages();
	// 			$this->system_message->set_success($messages);

	// 			// directly activate user
	// 			$this->ion_auth->activate($user_id);
	// 		}
	// 		else
	// 		{
	// 			// failed
	// 			$errors = $this->ion_auth->errors();
	// 			$this->system_message->set_error($errors);
	// 		}
	// 		refresh();
	// 	}

	// 	// get list of Frontend user groups
	// 	$this->load->model('group_model', 'groups');
	// 	$this->mViewData['groups'] = $this->groups->get_all();
	// 	$this->mPageTitle = 'Create User';

	// 	$this->mViewData['form'] = $form;
	// 	$this->render('user/create');
	// }
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
					'point'			=> 0
				);
			} else {
				$users_category = array(
					'user_id'		=> $this->mUser->id,
					'category_id'	=> $category['id'],
					'point'			=> 10
				);
			}
			$this->db->insert('users_categorys', $users_category);
		}
		$location = 100 - $this->input->post('decision');
		$user_behavior = array(
			'user_id'	=> $this->mUser->id,
			'interest'	=> $this->input->post('decision'),
			'location'	=> $location
		);
		$this->db->insert('user_behaviors', $user_behavior);
		redirect('home');
	}
}