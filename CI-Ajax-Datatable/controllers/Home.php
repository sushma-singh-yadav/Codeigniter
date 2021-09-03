<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct()
  {
   parent::__construct();
   $this->load->model('home_model');
 }

 public function index()
 {
   $this->load->view('table-view');
 }
 public function getCategory(){
  $filter_data = $this->input->post('filter_data');
  parse_str($filter_data, $params);
  $category = $this->home_model->categoryList($params);
  $json_data['data'] = $category;
  echo json_encode($json_data);
 }
}
