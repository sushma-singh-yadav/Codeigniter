<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('createCaptcha'))
{
	function createCaptcha($sessionname)
	{
        	$CI=& get_instance();
                $vals = array(
                //'word'          => 'Randdfdom word',
                'img_path'      => './captcha-images/',
                'img_url'       => base_url().'captcha-images/',
                'font_path'     => BASEPATH.'/fonts/texb.ttf',
                'img_width'     => '150',
                'img_height'    => 50,
                'expiration'    => 7200,
                'word_length'   => 5,
                'font_size'     => 25,
                'img_id'        => 'Imageid',
                'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                // White background and border, black text and red grid
                'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 200, 200)
        	        )
        	);

        	$cap = create_captcha($vals);

        	$captchaword= $cap['word'];
        	$CI->session->unset_userdata($sessionname);
        	$CI->session->set_userdata($sessionname,$captchaword);
        	return $cap;
	}
}
?>