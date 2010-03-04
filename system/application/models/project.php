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
	
	public function edit($id, $project){}
	
	public function delete($id){}
	
	public function getproject($id){
		$this->db->select('projects.*, profile.company');
		$this->db->from('projects');
		$this->db->join('profile', 'profile.id = projects.profile_id');
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
	
	public function featured(){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('profile', 'profile.id = projects.profile_id');
		$this->db->where('projects.is_featured', 'on');
		$this->db->where('projects.is_public', 'on');
		$this->db->order_by('projects.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function recent(){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('profile', 'profile.id = projects.profile_id');
		$this->db->where('projects.is_public', 'on');
		$this->db->order_by('projects.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}

}