<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserInfo extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/

	public function register()
	{
		$arr['page'] = 'UserInfo/register';
		$this->load->view('frontend/register', $arr);
	}

	public function registering()
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'email' => strtolower($this->input->post('email')),
			'username' => strtolower($this->input->post('email')),
			'password' => $this->input->post('password'),
			'role' => NULL
		);
		$confirm = $this->input->post('confirm');

		$this->load->model('User', 'user', FALSE);
		$this->user->register($data);
		redirect(base_url().'Home/login');
	}

	public function editAccount()
	{
		$arr['page'] = "UserInfo/editAccount";

		$this->load->model('User', 'user', FALSE);

		$user = $this->session->userdata("user");
		$this->user->checkSession($arr['page']);

		$arr['user'] = $user;
		$this->load->view('frontend/register', $arr);
	}

	public function editedAccount()
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'email' => strtolower($this->input->post('email')),
			'username' => strtolower($this->input->post('username')),
			'password' => $this->input->post('password'),
		);

		$this->load->model('User', 'user', FALSE);
		$this->user->editAccount($data);
		redirect(base_url());
	}

	public function findEmail()
	{
		$email = $this->input->post('email');
		$this->load->model('User', 'user', FALSE);
		$arr['rs'] = $this->user->findEmail($email);
		echo json_encode($arr);
	}

	public function findUsername()
	{
		$username = $this->input->post('username');
		$this->load->model('User', 'user', FALSE);
		$arr['rs'] = $this->user->findUsername($username);
		echo json_encode($arr);
	}

}
