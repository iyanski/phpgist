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
		$this->db->insert('applicants',$data);
		return $this->db->insert_id();
	}

	public function get_applicants_of($project_id){
		$this->db->select('*');
		$this->db->from('applicants');
		$this->db->where('applicants.project_id', $project_id);
		$this->db->order_by('applicants.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}
}