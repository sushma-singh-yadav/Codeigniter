<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('fileupload');
	}
	public function index()
	{
		$this->load->view('index');
	}
	public function submitFile()
	{
		echo $image_new=fileuploadCI('upload_file','uploads');
	}
}