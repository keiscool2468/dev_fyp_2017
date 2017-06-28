<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */public function __construct()
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
			$identity = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');
			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// login succeed
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
				redirect('home');
			}
			else
			{
				// login failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}
		
		$this->mViewData['form'] = $form;
		$this->render('login', 'empty');
	}
	public function logout()
	{
		$this->ion_auth->logout();
		redirect('home');
	}
}