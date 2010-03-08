<?php

class Home extends Controller {

	public function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
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
	
	function signup(){
		$this->load->library('form_validation');
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		//init active record for profile
		$this->load->model('User','',TRUE);
		if ($this->form_validation->run() == FALSE){
			
			$this->session->set_userdata('token', md5(time() + rand()));
			$data['token'] = $this->session->userdata('token');
			$this->load->view('home/signup', $data);
			
		}else{
			
		}
		$this->load->view('common/footer');
	}
	
	function post()
	{
		$this->load->library('form_validation');
		//init active record for profile
		$this->load->model('User','',TRUE);
		$this->load->model('Project','',TRUE);
		$this->load->model('Profile','',TRUE);
		$this->form_validation->set_error_delimiters('<p class="error">', '</div>');
		$data['user'] = $this->session->userdata('user');
		$data['token'] = $this->session->userdata('token');
		$data['title'] = "phpgist.com - new project";
		$profile_id = false; //init profile id to null
		
		//retrieve company if logged in
		if(!empty($data['user']['id'])){
			$existing_profile = $this->Profile->get_profile($data['user']['id']);
			$data['company'] = $existing_profile->company;
			$data['email'] = $existing_profile->email;
			$profile_id = $existing_profile->id;
		}
		
		//set validation for account information
		if((!empty($_POST['account'])) && ($_POST['account'] == "old")){
			
			//only validate if user is not logged in
			if(empty($profile_id)){
				$this->form_validation->set_rules('users[login]', 'Username', 'required|min_length[5]|max_length[12]|xss_clean');
				$this->form_validation->set_rules('users[password]', 'Password', 'required');
			}
			
		}elseif((!empty($_POST['account'])) && ($_POST['account'] == "new")){

			//user validation
			$this->form_validation->set_rules('newusers[login]', 'Username', 'required|min_length[5]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('newusers[password]', 'Password', 'required');
			$this->form_validation->set_rules('newusers[confirm_password]', 'Password Confirmation', 'required');
			
			//profile validation
			$this->form_validation->set_rules('profile[email]', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('profile[firstname]', 'First Name', 'required');
			$this->form_validation->set_rules('profile[lastname]', 'Last Name', 'required');
		}
		
		//set validation for project information
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
				
				//check if this is a new account or not. Main goal is to provide a profile_id for the new post
				if((!empty($_POST['account'])) && ($_POST['account'] == "new")){
					//create user
					$user_id = $this->User->create($_POST['newusers']);
					
					//assign user_id to profile
					$new_profile = $_POST['profile'];
					$new_profile['user_id'] = $user_id;

					//create profile
					$profile_id = $this->Profile->create($new_profile);
					
				}elseif((!empty($_POST['account'])) && ($_POST['account'] == "old")){

					//login and pull user details if user has an account already
					if(!empty($_POST['users'])){
						$login = $this->User->login($_POST['users']);
						$profile_id = ($login) ? $this->Profile->get_profile_id($login->id) : false;
					}
				}
				
				if(empty($_POST['i_agree'])){
					$profile_id = false;
				}
				
				if($profile_id){
					
					//assign profile_id to project
					$project = $_POST['project'];
					$project['profile_id'] = $profile_id;
					
					//assign email to project
					$project['email'] = $_POST['profile']['email'];

					//create project
					$this->Project->create($project);

					$this->load->view('home/posted');
					
				}else{
					
					$data['error'] = "Please check your username and password!";
					$this->session->set_userdata('token', md5(time() + rand()));
					$data['token'] = $this->session->userdata('token');
					
					if(empty($_POST['i_agree'])){
						$data['error'] = "You have to agree to our Terms and Agreement and privacy policy to make this post!";
					}
					$this->load->view('home/post', $data);
					
				}				
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
		
		$this->load->model('User','',TRUE);
		$this->load->model('Profile','',TRUE);
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		$account = false;
		
		if(!empty($_POST['users'])){
			if($user = $this->User->login($_POST['users'])){
				$profile = $this->Profile->get_profile($user->id);
				$account['id'] = $user->id;
				$account['login'] = $user->login;
				$account['profile_id'] = $profile->id;
				$account['firstname'] = $profile->firstname;
				$account['lastname'] = $profile->lastname;
				$this->session->set_userdata('user', $account);
				header('Location: '.base_url().'account/index');
			}
		}

		$this->load->view('home/login');
		$this->load->view('common/footer');
	}
	
	function logout(){
		$this->session->unset_userdata('user');
		header('Location: '.base_url().'home/index');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */