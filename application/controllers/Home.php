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
		(!$this->user->login($username, $password)) ? redirect(base_url().'Home/login'): redirect(base_url().'Dashboard');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }

}
