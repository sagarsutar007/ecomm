<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SetupModel extends CI_Model {

	public $users_table = "users_tbl";
	public $store_table = "store_tbl";

	public function __construct()
	{
		parent::__construct();
	}

	public function getAdminInformation()
	{
		$this->db->select('id, name, email, photo, gender, created_date');
		return $this->db->get_where($this->users_table, ['type'=>'superadmin'])->row_array();
	}

	public function createStoreUser($value='')
	{
		$this->db->insert($this->users_table, $value);
		return $this->db->insert_id();
	}

	public function createStore($value='')
	{
		$this->db->insert($this->store_table, $value);
		return $this->db->insert_id();
	}

	public function getStoreInformation()
	{
		return $this->db->get($this->store_table)->row_array();
	}

}

/* End of file SetupModel.php */
/* Location: ./application/models/SetupModel.php */