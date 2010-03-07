<?php
class Users extends Controller
{
	public function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	#API Calls
	function auth(){
		$this->load->model('User','',TRUE);
		$this->load->model('Profile','',TRUE);
		if(!empty($_POST)){
			if($user = $this->User->login($_POST)){
				$profile = $this->Profile->get_profile($user->id);
				$account['id'] = $user->id;
				$account['login'] = $user->login;
				$account['profile_id'] = $profile->id;
				$account['firstname'] = $profile->firstname;
				$account['lastname'] = $profile->lastname;
				$this->session->set_userdata('user', $account);
				echo "Login Successful!";
			}else{
				echo "Access Denied. Please Try Again.";
			}
		}
	}
}