<?php
class Applicant extends Model
{

    public function __construct()
    {
        parent::Model();
    }

	public function get_applicants($project_id){
		$this->db->select('*');
		$this->db->from('applicants');
		$this->db->where('applicants.project_id', $project_id);
		$this->db->order_by('applicants.id', 'desc');
		$result = $this->db->get();
		return $result->result();
	}
}