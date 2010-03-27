<?php
class Applicant extends Model
{

    public function __construct()
    {
        parent::Model();
    }

	public function create($project_id, $data){
		$data['project_id'] = $project_id;
		$data['created_on'] = date("Y-m-d h:i:s", time());
		$data['coverletter'] = str_replace("\n", "</p><p>", $data['coverletter']);
		$data['resume'] = str_replace("\n", "</p><p>", $data['resume']);
		$this->db->insert('applicants',$data);
		return $this->db->insert_id();
	}

	public function get_applicants_of($project_id){
		$this->db->select('*');
		$this->db->from('applicants');
		$this->db->where('applicants.project_id', $project_id);
		$this->db->order_by('applicants.id', 'desc');
		$result = $this->db->get();
		$results = $result->result();
		if(!empty($results)) foreach($results as $key => $item){
			$results[$key]->created_on = date("F d, Y", strtotime($results[$key]->created_on));
		}
		return $results;
	}
	
	public function get_applicant($id){
		$this->db->select('*, projects.id as project_id, projects.*');
		$this->db->from('applicants');
		$this->db->join('projects', "projects.id = applicants.project_id");
		$this->db->where('applicants.id', $id);
		$result = $this->db->get();
		$applicant = $result->result();
		return !empty($applicant) ? $applicant[0] : false;
	}
}