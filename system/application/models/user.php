<?php
class User extends Model
{

    public function __construct()
    {
        parent::Model();
    }
	
	public function create($user){
		unset($user['confirm_password']);
		$user['password'] = md5($user['password']);
		$user['created_on'] = date("Y-m-d h:i:s", time());
		$this->db->insert('users',$user);
		return $this->db->insert_id();
	}
	
	public function edit($id, $user){}
	
	public function delete($id){}
	
	public function login($login){
		$user = $this->db->get_where('users', array('login' => $login['username'], 'password' => md5($login['password'])));
		$login = $user->result();
		unset($login[0]->password);
		return $login;
	}
	
	public function logout(){}

}