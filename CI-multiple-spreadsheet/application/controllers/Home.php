<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function multiple_spreadsheet()
	{
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=myexcel.xlsx');
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1','service worksheet');
		$spreadsheet->getActiveSheet()->setTitle('Service');

		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(1)->setCellValue('A1','New Worksheet');
		$spreadsheet->getActiveSheet()->setTitle('Product');

		$spreadsheet->setActiveSheetIndex(0);
		
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}