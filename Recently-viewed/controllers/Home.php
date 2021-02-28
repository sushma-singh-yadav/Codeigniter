<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index()
	{
		$productList=$this->home_model->productList();
		$this->load->view('head');
		$this->load->view('product-list',['productList'=>$productList]);
		if(array_key_exists('recentviewed', $_COOKIE))
		{
			$cookie_get=get_cookie('recentviewed');
			$cookieres=unserialize($cookie_get);
			$productids=implode("','", $cookieres);

			///get product details
			$where="product_id IN ('$productids')";
			$recentviewedList=$this->home_model->productListWithID($where);
			$this->load->view('recently-viewed',['recentviewedList'=>$recentviewedList]);
		}
		$this->load->view('footer');
	}

	public function productView()
	{
		$product_id=$this->uri->segment(3);
		$productdata=$this->home_model->productView($product_id);

		if(array_key_exists('recentviewed', $_COOKIE))
		{
			//already set
			$cookie_get=get_cookie('recentviewed');
			$cookieres=unserialize($cookie_get);
			///check product already present
			if(!in_array($product_id, $cookieres))
			{
				$cookieres[]=$product_id;
			}
			delete_cookie('recentviewed');

			///again set cookie
			$cookievalue=serialize($cookieres);
			$cookiearr=array(
				'name'=>'recentviewed',
				'value'=>$cookievalue,
				'expire'=>'86400'
			);
			$this->input->set_cookie($cookiearr);

		} else { 
		///cookie set
		$cookie_data[]=	$product_id;
		$cookievalue=serialize($cookie_data);
		$cookiearr=array(
			'name'=>'recentviewed',
			'value'=>$cookievalue,
			'expire'=>'86400'
		);
		$this->input->set_cookie($cookiearr);
		}

		$this->load->view('head');
		$this->load->view('product-view',['productdata'=>$productdata]);
		$this->load->view('footer');
	}
}