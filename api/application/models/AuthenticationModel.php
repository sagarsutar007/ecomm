<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthenticationModel extends CI_Model {

	public $users_table = "users_tbl";
	public $store_table = "store_tbl";
	public $auth_table = "auth_tbl";

	public function __construct()
	{
		parent::__construct();
	}

	public function generateApiToken($user_id='', $type="web", $ip="")
	{
		$uniq_id = str_shuffle(uniqid() . rand(111111, 999999));
		$this->db->insert($this->auth_table, [
			"user_id" => $user_id,
			"type" => $type,
			"api_token" => $uniq_id,
			"created_date" => date("Y-m-d h:i:s"),
			"ip_address" => $ip
		]);
		return $uniq_id;
	}

	public function updateApiToken($user_id='', $type="web", $ip="")
	{
		$uniq_id = str_shuffle(uniqid() . rand(111111, 999999));
		$this->db->update($this->auth_table, [
			"api_token" => $uniq_id,
			"updated_date" => date("Y-m-d h:i:s"),
			"ip_address" => $ip
		], [ "user_id" => $user_id, "type" => $type]);
		return $uniq_id;
	}

	public function fetchApiToken($user_id='', $type="web")
	{
		return $this->db->get_where($this->auth_table, ["user_id" => $user_id, "type" => $type])->row_array();
	}

}

/* End of file AuthenticationModel.php */
/* Location: ./application/models/AuthenticationModel.php */