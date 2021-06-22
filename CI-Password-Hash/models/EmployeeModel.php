<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function insertEmployee($data)
	{
		$this->db->insert('employee',$data);
		return $this->db->insert_id();
	}

	public function selectEmployee($id)
	{
		$this->db->select('*');
		$this->db->where('emp_email',$id);
		$this->db->from('employee');
		$query=$this->db->get();
		return $query->result();
	}
}
?>