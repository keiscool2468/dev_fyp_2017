<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

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
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
            $profile = array(
				'username'							=> $this->input->post('username'),
				'first_name'						=> $this->input->post('first_name'),
				'last_name'					        => $this->input->post('last_name'),
				'phone'						        => $this->input->post('phone'),
				'company'							=> $this->input->post('company'),
			);
			$password = array('password' => $this->input->post('password'));
            $user_id = $this->mUser->id;
            $this->reset_password($user_id, $password);
		}
	}
    public function reset_password($user_id, $password)
	{
        // proceed to change user password
        if ($this->ion_auth->update($user_id, $password))
        {
            // $messages = $this->ion_auth->messages();
            // $this->system_message->set_success($messages);
        }
        else
        {
            // $errors = $this->ion_auth->errors();
            // $this->system_message->set_error($errors);
        }
		redirect('home');
	}
}