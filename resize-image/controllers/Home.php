<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function imageUpload()
	{
		$imageName = $_FILES['upload_image']['name'];
		$imageTempName = $_FILES['upload_image']['tmp_name'];

		$imagesize = getimagesize($imageTempName);

		$config = array(
			'upload_path' => 'uploads',
			'file_name' => $imageName,
			'allowed_types' => 'jpg|jpeg|png'
		);
		$this->load->library('upload',$config);

		if($this->upload->do_upload('upload_image'))
		{
			$uploadedData = $this->upload->data();
			$upload_file = $uploadedData['file_name'];
			
			echo 'Image Uploaded';

			$this->resizeImage($upload_file);
		} else{
			echo $this->upload->display_errors();
		}
	}

	public function resizeImage($file_name){
		$source = FCPATH . '/uploads/' . $file_name;
		$dest = FCPATH . '/upload-new';

		$config['image_library'] = 'gd2';
		$config['source_image'] = $source;
		$config['new_image'] = $dest;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 75;
		$config['height']       = 50;

		$this->load->library('image_lib', $config);

		if(!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}

			echo 'Image Resized';
	}
}
?>