<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('EmployeeModel');
	}

	public function index()
	{
		$this->load->view('head');
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function signup()
	{
		$this->load->view('head');
		$this->load->view('signup');
		$this->load->view('footer');
	}
	public function signupDb()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|min_length[6]');
		if ($this->form_validation->run()) {
			//true
			//save to db
			$pass=$this->input->post('pass');
			$password=password_hash($pass, PASSWORD_DEFAULT);

			$data=array(
				'emp_name'=>$this->input->post('name'),
				'emp_email'=>$this->input->post('email'),
				'emp_password'=>$password
			);
			$insertid = $this->EmployeeModel->insertEmployee($data);

			if($insertid)
			{
				$this->session->set_flashdata('message','You have successfully registered. Please login.');
				redirect('home');
			}
			else{
				$this->session->set_flashdata('message','You have not registered. Please try again.');
				redirect('home/signup');
			}
		} else{
			//false
			$this->form_validation->set_error_delimiters('<span style="color:red;">','</span>');
			$this->load->view('head');
			$this->load->view('signup');
			$this->load->view('footer');
		}
	}
	public function loginDB()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|min_length[6]');
		if ($this->form_validation->run()) {
			//true
			$emp_email=$this->input->post('email');
			$emp_password=$this->input->post('pass');
			$emp_data= $this->EmployeeModel->selectEmployee($emp_email);

			if(count($emp_data)>0)
			{
				$employee_password=$emp_data[0]->emp_password;
				if (password_verify($emp_password, $employee_password)) {
					//redirect to your dashboard and set session
					redirect('home/dashboard');
				} else{
				$this->session->set_flashdata('message','Password is incorrect.');
				redirect('home');	
				}
			} else{
				$this->session->set_flashdata('message','User email is not valid.');
				redirect('home');
			}
		}
		else{
			//false
			$this->form_validation->set_error_delimiters('<span style="color:red;">','</span>');
			$this->load->view('head');
			$this->load->view('login');
			$this->load->view('footer');
		}
	}
	public function dashboard(){
		echo '<h1>Welcometo dashboard</h1>';
	}
}
