<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->helper('captchaCustomer');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('index');
	}
	public function registerSubmit()
	{
		$captcha=$this->input->post('captcha');

		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('captcha','captcha','required|callback_check_captcha');
		if($this->form_validation->run()==false)
		{
			$this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');
			$this->load->view('index');
		}
		else
		{
			///insert into database or redirect
			$this->session->set_flashdata('error','<div class="alert alert-success">Captcha matched</div>');
			redirect('home');
		}
	}
	public function check_captcha($captchacode)
	{
		$captcha_answer=$this->session->userdata('captchaword');
		if($captchacode==$captcha_answer)
		{
			return true;
		}
		else{
			$this->form_validation->set_message('check_captcha','Captcha does not match.');
			return false;
		}
	}
	public function getNewCaptcha()
	{
		$cap=createCaptcha('captchaword');
		$image= $cap['image'];
		echo $image;
	}
}