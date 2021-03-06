<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index()
	{
		$this->load->helper('captcha');
		$vals = array(
        //'word'          => 'Randdfdom word',
        'img_path'      => './captcha-images/',
        'img_url'       => base_url().'captcha-images/',
        'font_path'     => './path/to/fonts/texb.ttf',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 8,
        'font_size'     => 16,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
		        )
		);

		$cap = create_captcha($vals);
		$image= $cap['image'];
		$captchaword= $cap['word'];
		$this->session->set_userdata('captchaword',$captchaword);
		$this->load->view('index',['captcha_image'=>$image]);
	}
	public function registerSubmit()
	{
		$captcha=$this->input->post('captcha');
		$captcha_answer=$this->session->userdata('captchaword');

		///check both captcha
		if($captcha==$captcha_answer)
		{
			$this->session->set_flashdata('error','<div class="alert alert-success">Captcha is matched.</div>');
			redirect('home');
		}
		else{
			$this->session->set_flashdata('error','<div class="alert alert-danger">Captcha does not match.</div>');
			redirect('home');
		}
	}
}