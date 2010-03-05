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
	
	public function get_profile_id($user_id){
		$user = $this->db->get_where('users', array('id' => $user_id));
		$profile = $user->result();
		return !empty($profile[0]) ? $profile[0]->id : false;
	}
	
	public function get_profile($user_id){
		$user = $this->db->get_where('profile', array('user_id' => $user_id));
		$profile = $user->result();
		return !empty($profile[0]) ? $profile[0] : false;
	}

}