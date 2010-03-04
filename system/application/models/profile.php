<?php
class Profile extends Model
{

    public function __construct()
    {
        parent::Model();
    }

	public function create($profile){
		$this->db->insert('profile',$profile);
		return $this->db->insert_id();
	}
	
	public function edit($id, $profile){}
	
	public function delete($id){}

}