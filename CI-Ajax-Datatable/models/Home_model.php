<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function categoryList($params)
	{
		$this->db->select('*');
		if($params['f_status']!='')
		{
		$this->db->where('status',$params['f_status']);
		}
		$query = $this->db->get('category_master');
		return $query->result();
	}
}
?>