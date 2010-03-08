<?php
class Project extends Model
{

    public function __construct()
    {
        parent::Model();
    }

	public function create($project){
		$project['compensation'] = (!empty($project['tbd'])) ? 'TBD' : $project['compensation'];
		unset($project['tbd']); //do not include this field
		$project['created_on'] = date("Y-m-d h:i:s", time());
		$project['description'] = str_replace("\n","</p><p>", $project['description']);
		$project['qualifications'] = str_replace("\n","</p><p>", $project['qualifications']);

		$this->db->insert('projects',$project);
		return $this->db->insert_id();
	}
	
	public function edit($id, $data){
		$data['description'] = str_replace("\n", "</p><p>", $data['description']);
		$data['qualifications'] = str_replace("\n", "</p><p>", $data['qualifications']);
		$this->db->where("id", $data['project_id']);
		unset($data['project_id']);
		return $this->db->update("projects", $data);
	}
	
	public function delete($project_id, $profile_id = ""){
		$this->db->where("profile_id", $profile_id);
		$this->db->where("id", $project_id);
		return $this->db->delete("projects");
	}
	
	public function getproject($id){
		$this->db->select('projects.*, profile.company');
		$this->db->from('projects');
		$this->db->join('profile', "profile.id = projects.profile_id");
		$this->db->where('projects.id', $id);
		$this->db->order_by('projects.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function getprojectname($id){
		$this->db->select('projects.name, projects.qualifications, profile.url');
		$this->db->from('projects');
		$this->db->join('profile', 'profile.id = projects.profile_id');
		$this->db->where('projects.id', $id);
		$this->db->order_by('projects.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function getmyprojects($profile_id){
		$result = $this->db->query("SELECT projects.*, profile.id as profile_id FROM projects, profile WHERE profile.id = projects.profile_id AND profile.id = '{$profile_id}'");
		return $result->result();
	}
	
	public function featured(){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('profile', 'profile.id = projects.profile_id');
		$this->db->where('projects.is_featured', 'on');
		$this->db->where('projects.is_public', 'on');
		$this->db->where('profile.is_active', 'on');
		$this->db->order_by('projects.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function recent(){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('profile', "profile.id = projects.profile_id");
		$this->db->where('projects.is_public', 'on');
		$this->db->where('profile.is_active', 'on');
		$this->db->order_by('projects.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}

}