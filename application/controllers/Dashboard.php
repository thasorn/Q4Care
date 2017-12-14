<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->load->model('Reserv', 'reserv', FALSE);
		$user = $this->session->userdata("user");
		(!empty($user))? : redirect(base_url().'Home/login');
		$arr['user'] = $user;
		$this->load->view('frontend/home', $arr);
	}

	public function reservQue()
	{
		$this->load->model('Reserv', 'reserv', FALSE);

		$user = $this->session->userdata("user");
		(!empty($user))? : redirect(base_url().'Home/login');

		$arr['user'] = $user;
		$arr['departments'] = $this->reserv->getDepartments();
		$arr['periods'] = $this->reserv->getPeriod();
		$this->load->view('frontend/reserv', $arr);
	}

	public function getReservDetail($dep_id)
	{
		$this->load->model('Reserv', 'reserv', FALSE);

		$doctors = $this->reserv->getDoctors($dep_id);
		$arr['rs'] = '';
		foreach ($doctors[$dep_id] as $row) {
			$arr['rs'] = $arr['rs'].'<option value="'.$row['id'].'">นายแพทย์'.$row['fname'].' '.$row['lname'].'</option>';
		}
		//print_r($arr);
		header('content-type: application/json; charset=utf-8');
		echo json_encode($arr);
	}

	public function getTime($dep_id)
	{
		$this->load->model('Reserv', 'reserv', FALSE);
		$date = $this->input->post('date');
		$all = $this->reserv->getFreePeriod($dep_id, $date);
		$js = '';
		foreach ($all as $row) {
			$js = $js.'<input type="submit" name="time" class="btn btn-danger col-lg-4 col-md-1 col-sm-4 col-xs-6 gallery_product filter hdpe" value="'.$row['start'].' - '.$row['stop'].'" />';
		}
		//print_r($arr);
		header('content-type: application/json; charset=utf-8');
		echo json_encode(array('rs'=>$js));
	}

	public function reservTransaction()
	{
		$this->load->model('Reserv', 'reserv', FALSE);

		$user = $this->session->userdata("user");
		(!empty($user))? : redirect(base_url().'Home/login');

		$symp = $this->input->post('symptom');
		$time = explode(' - ', $this->input->post('time'));
		$date = $this->input->post('date');
		$doctor = $this->input->post('doctor');
		$this->reserv->createTransaction($symp, $date, $time[0], $doctor);

		redirect(base_url());
	}

	public function cancelReserv($reservId)
	{
		$this->load->model('Reserv', 'reserv', FALSE);

		//use user->checkSession instead
		$user = $this->session->userdata("user");
		(!empty($user))? : redirect(base_url().'Home/login');

		$this->reserv->cancel($reservId);

		redirect(base_url());
	}

	public function manageQue()
	{
		date_default_timezone_set('Asia/Bangkok');
		$this->load->model('Reserv', 'reserv', FALSE);
		$user = $this->session->userdata("user");
		(!empty($user))? : redirect(base_url().'Home/login');

		$this->reserv->sendMailToUser();

		$arr['user'] = $user;
		$arr['now'] = date('Y-m-d');
		$arr['queLists'] = $this->reserv->getQueToday($user['dep']);
		$arr['doctors'] = $this->reserv->getDoctors($user['dep'])[$user['dep']];
		$this->load->view('frontend/manage', $arr);
	}

	public function createWalk()
	{
		$dep_id = $this->input->post('dep');
		$user = $this->input->post('user');
		$date = $this->input->post('date').' '.$this->input->post('time');
		$doctor = $this->input->post('doc');
		redirect(base_url().'manageQue');
	}

	public function myReserv()
	{
		$this->load->model('Reserv', 'reserv', FALSE);
		$user = $this->session->userdata("user");
		$arr['user'] = $user;
		(!empty($user))? : redirect(base_url().'Home/login');
		$this->load->view('frontend/myReserv', $arr);
	}

	public function queing(){
		$this->load->model('Queue', 'que', FALSE);
		$dep = $this->que->getDep();
		$arr['queNumber'] = $this->que->getQueue($dep);
		$this->load->view('frontend/queue', $arr);
	}

	public function queueDetail(){
		$this->load->model('QueueDetail', 'queueDetail', FALSE);
		$arr['detail'] = $this->queueDetail->getQueueDetail();
		$this->load->view('frontend/queueDetail', $arr);
	}
}
