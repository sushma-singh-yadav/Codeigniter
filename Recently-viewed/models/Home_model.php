<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
	}

	public function productList()
	{
		$this->db->select('*');
		$this->db->where('product_status','Enable');
		$qry=$this->db->get('product');
		return $qry->result();
	}
	public function productView($id)
	{
		$this->db->select('*');
		$this->db->where('product_id',$id);
		$this->db->where('product_status','Enable');
		$qry=$this->db->get('product');
		return $qry->row();
	}
	public function productListWithID($where)
	{
		$this->db->select('*');
		$this->db->where($where);
		$this->db->where('product_status','Enable');
		$qry=$this->db->get('product');
		return $qry->result();
	}
}