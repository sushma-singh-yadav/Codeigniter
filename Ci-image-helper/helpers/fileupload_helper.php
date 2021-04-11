<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('fileuploadCI')) {
	function fileuploadCI($imagename,$folder)
	{
		$image=$_FILES[$imagename]['name'];
		$CI =& get_instance();
		$config=array(
			'upload_path' => $folder,
			'allowed_types' => 'pdf|jpg|jpeg|png',
			'max_size'=>'100000',
			'file_name'=>$image
		);
		$CI->load->library('upload',$config);
		$CI->upload->initialize($config);
		if ($CI->upload->do_upload($imagename)) {
			return $image;
		} else {
			return 'Not Uploaded';
		}
	}
}
?>