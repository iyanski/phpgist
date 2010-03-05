<?php

class Projects extends Controller {

	public function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->helper(array('form', 'url'));
		$this->load->model('Project','',TRUE);
		$this->load->library('session');
	}
	
	public function index(){
		$data['featured'] = $this->Project->featured();
		$data['recent'] = $this->Project->recent();
		$data['title'] = "Gist for PHP job opportunities, PHP freelance projects, web design jobs for creative professionals";
		
		$this->load->view('common/html', $data);
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$this->load->view('project/index', $data);
		$this->load->view('common/footer');
	}
	
	public function item($id="", $name=""){
		$project = $this->Project->getproject($id);
		$data['project'] = !empty($project) ? $project[0] : false;
		$data['title'] = !empty($project) ? $project[0]->name." at phpgist" : false;

		$this->load->view('common/html', $data);
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$this->load->view('project/item', $data);
		$this->load->view('common/footer');
	}
	
	public function apply($id){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="error">', '</div>');
		$data['user'] = $this->session->userdata('user');
		$data['token'] = $this->session->userdata('token');
		
		$project = $this->Project->getprojectname($id);
		$data['project'] = !empty($project) ? $project[0] : false;
		
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$this->load->view('project/apply', $data);
		$this->load->view('common/footer');
	}

}