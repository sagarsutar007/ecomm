<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	public $table = "users_tbl";
	public $fields = "id, name, email, phone, photo, gender, dob, type, authtoken, status, created_date, email_verified_at";

	public function __construct()
	{
		parent::__construct();
	}

	public function get($user_id='')
	{
		$this->db->select($this->fields);
		if(empty($user_id)){
			$result = $this->db->get($this->table);
			return $result->result_array();
		} else {
			$result = $this->db->get_where($this->table, ['id'=>$user_id]);
			return $result->row_array();
		}
	}	

	public function getEmailUser($email='')
	{
		$this->db->select("id, name, password");
		return $this->db->get_where($this->table, ['email'=>$email])->row_array();
	}

	public function setAuthtoken($user_id='', $token='')
	{
		$this->db->update($this->table, [ 'authtoken' => $token ], [ 'id' => $user_id ]);
		return $this->db->affected_rows();
	}

	public function getAuthUser($authtoken='')
	{
		$this->db->select($this->fields);
		return $this->db->get_where($this->table, ['authtoken'=>$authtoken])->row_array();
	}

	public function changeAuthtokenPassword($password='', $authtoken='')
	{
		$passw = password_hash($password, PASSWORD_DEFAULT);
		$this->db->update($this->table, ['password'=>$passw], ['authtoken'=>$authtoken]);
		return $this->db->affected_rows();
	}

	public function removeAuthtoken($authtoken='')
	{
		$this->db->update($this->table, ['authtoken'=>$authtoken], ['authtoken'=>$authtoken]);
		return $this->db->affected_rows();
	}
}

/* End of file  */
/* Location: ./application/models/ */