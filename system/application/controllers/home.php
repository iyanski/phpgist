<?php

class Home extends Controller {

	public function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
		$this->load->model('Project','',TRUE);
		$data['featured'] = $this->Project->featured();
		
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$this->load->view('index', $data);
		$this->load->view('common/footer');
	}
	
	function post()
	{
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="error">', '</div>');
		$data['user'] = $this->session->userdata('user');
		$data['token'] = $this->session->userdata('token');
		$data['title'] = "phpgist.com - new project";
		
		//remove validation if user is logged in
		if(!empty($data['user'])){
			$this->form_validation->set_rules('users[login]', 'Username', 'required|min_length[5]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('users[password]', 'Password', 'required|md5');
			$this->form_validation->set_rules('users[confirm_password]', 'Password Confirmation', 'required|md5');
		}
		
		$this->form_validation->set_rules('profile[email]', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('profile[firstname]', 'First Name', 'required');
		$this->form_validation->set_rules('profile[lastname]', 'Last Name', 'required');
		$this->form_validation->set_rules('project[name]', 'Project Name', 'required');
		$this->form_validation->set_rules('project[description]', 'Description', 'required');
		$this->form_validation->set_rules('project[qualifications]', 'Qualifications', 'required');
		
		
		$this->load->view('common/html', $data);
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		if ($this->form_validation->run() == FALSE){
			$this->session->set_userdata('token', md5(time() + rand()));
			$data['token'] = $this->session->userdata('token');
			$this->load->view('home/post', $data);
		}else{
			if((!empty($_POST['token'])) && ($this->session->userdata('token') == $_POST['token'])){
				$this->load->model('User','',TRUE);
				$this->load->model('Profile','',TRUE);
				$this->load->model('Project','',TRUE);
				
				//create user
				$user_id = $this->User->create($_POST['users']);
				
				//assign user_id to profile
				$profile = $_POST['profile'];
				$profile['user_id'] = $user_id;
				
				//create profile
				$profile_id = $this->Profile->create($profile);
				
				//assign profile_id to project
				$project = $_POST['project'];
				$project['profile_id'] = $profile_id;
				
				//create project
				$this->Project->create($project);

				$this->load->view('home/posted');
			}
		}
		$this->load->view('common/footer');
	}
	
	function page($id, $name = ""){
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$this->load->view('home/about');
		$this->load->view('common/footer');
	}
	
	function login(){
		$this->load->library('session');
		$this->logout();
		$this->load->model('User','',TRUE);
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');

		if(!empty($_POST['users'])){
			if($login = $this->User->login($_POST['users'])){
				$this->session->set_userdata('user', $login);
				header('Location: '.base_url().'home/index');
			}
		}
		$this->load->view('home/login');
		$this->load->view('common/footer');
	}
	
	function logout(){
		$this->session->unset_userdata('user');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */