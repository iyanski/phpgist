<?php

class Account extends Controller {

	public function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	function dashboard(){
		$this->load->model('Project','',TRUE);
		$user = $this->session->userdata('user');
		$data['projects'] = $this->Project->getmyprojects($user['profile_id']);
		$data['title'] = "phpgist: Account Dashboard";
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$this->load->view('account/index', $data);
		$this->load->view('common/footer');
	}
}