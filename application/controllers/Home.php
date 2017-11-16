<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index()
	{
		$this->load->view('frontend/home');
	}

  public function login()
  {
		if ($this->session->userdata("user") != NULL){
			redirect(base_url().'Dashboard');
		} else {
			$this->load->view('frontend/login');
		}
  }

  public function loggingIn()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $this->load->model('User', 'user', FALSE);
    /*if (!$this->user->login($username, $password)){
    	redirect(base_url().'Home/login');
    } else {
			redirect(base_url().'Dashboard');
    }*/
		(!$this->user->login($username, $password)) ? redirect(base_url().'Home/login'): redirect(base_url().'Dashboard');
  }

	public function register()
	{
		$this->load->view('frontend/register');
	}

	public function registering()
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('email'),
			'password' => $this->input->post('password'),
		);
		$confirm = $this->input->post('confirm');
		if ($confirm != $data['password']){
			echo "<script type=\"text/javascript\">alert('Invalid confirm password');</scirpt>";
			redirect(base_url().'Home/register');
		}

		$this->load->model('User', 'user', FALSE);
		$this->user->register($data);
		redirect(base_url().'Home/login');
	}
}
