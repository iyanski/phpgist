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
		$this->load->model('Applicant','',TRUE);
		$this->form_validation->set_error_delimiters('<p class="error">', '</div>');
		$data['user'] = $this->session->userdata('user');
		$data['token'] = $this->session->userdata('token');
		
		$this->form_validation->set_rules('applicant[firstname]', 'First Name', 'required');
		$this->form_validation->set_rules('applicant[lastname]', 'Last Name', 'required');
		$this->form_validation->set_rules('applicant[email]', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('applicant[url]', 'Portfolio', 'required');
		$this->form_validation->set_rules('applicant[resume]', 'Resume', 'required');
		$this->form_validation->set_rules('applicant[coverletter]', 'Cover Letter', 'required');
		$this->form_validation->set_rules('applicant[experience]', 'Years of Experience', 'required|numeric');
		$this->form_validation->set_rules('i_agree', 'Agree to Terms and Conditions', 'required');
		
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		
		if ($this->form_validation->run() == FALSE){
			$project = $this->Project->getprojectname($id);
			$data['project'] = !empty($project) ? $project[0] : false;
			$this->load->view('project/apply', $data);
		}else{
			$project = $this->Applicant->create($id, $_POST['applicant']);
			$this->load->view('project/applied');
		}
		
		$this->load->view('common/footer');
	}

	public function save(){
		$this->load->view('common/html');
		$this->load->view('common/head');
		$this->load->view('common/body');
		$this->load->view('common/menu');
		if(!empty($_POST['projects']['project_id'])){
			$user = $this->session->userdata("user");
			$project = $this->Project->edit($_POST['projects']['project_id'], $_POST['projects']);
			echo $this->load->view('project/save');
		}
		$this->load->view('common/footer');
		//header("Location: ".base_url()."account/dashboard");
	}
	
	#api calls
	public function get_project($id=""){
		if(!empty($id)){
			$project = $this->Project->getproject($id);
			if(!empty($project)){
				$item['items'] = $project[0];
				$item['items']->description = str_replace("\n","</p><p>",$project[0]->description);
				$item['items']->qualifications = str_replace("\n","</p><p>",$project[0]->qualifications);
				echo json_encode($item);
			}
		}
	}
	
	public function edit($id=""){
		if(!empty($id)){
			$project = $this->Project->getproject($id);
			if(!empty($project)){
				$item['items'] = $project[0];
				$item['items']->description = str_replace("</p><p>","\n",$project[0]->description);
				$item['items']->qualifications = str_replace("</p><p>","\n",$project[0]->qualifications);
				echo json_encode($item);
			}
		}
	}
	
	public function get_applicants($id){
		$this->load->model('Applicant','',TRUE);
		if(!empty($id)){
			$applicants = $this->Applicant->get_applicants_of($id);
			$item['items'] = !empty($applicants) ? $applicants : "";
			echo json_encode($item);
		}
	}
	
	public function destroy($id){
		if(!empty($id)){
			$user = $this->session->userdata("user");
			$project = $this->Project->delete($id, $user['profile_id']);
			echo ($project) ? 1 : 0;
		}
	}

}