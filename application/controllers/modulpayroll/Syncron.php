<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Syncron extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_syncron');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'page_content' 	=> '../pagepayroll/syncron/view',
				'ribbon' 		=> '<li class="active">Syncron</li>',
				'page_name' 	=> 'Absen Finger',
				'js' 			=> 'js_file'
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function import()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$files = $_FILES;
			$file = $files['file'];
			$fname = $file['tmp_name'];
			$file = $_FILES['file']['name'];
			$fname = $_FILES['file']['tmp_name'];
			$ext = explode('.', $file);
			/** Include path **/
			set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
			/** PHPExcel_IOFactory */
			include 'PHPExcel/IOFactory.php';
			$objPHPExcel = PHPExcel_IOFactory::load($fname);
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, false, true);
			$data_exist = [];
			$empty_message = [];

			foreach ($allDataInSheet as $ads) {
				if (array_filter($ads)) {
					array_push($data_exist, $ads);
				}
			}
			foreach ($data_exist as $keys => $value) {
				if ($keys == '0') {
					continue;
				} else {
					if (!$value[1]) {
						array_push($empty_message, "No at row "  . $keys . " Nama harus di isi");
					}
					if (!$value[2]) {
						array_push($empty_message, "No at row "  . $keys . " Tanggal harus di isi");
					}

					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
					$arrayCustomerQuote = array(
						'pin' => $value[1],
						'tanggal' => $value[2],
						'status' => 0,
						'createdAt'	=> date('Y-m-d H:i:s')
					);
					$result = $this->model_syncron->insert($arrayCustomerQuote, 'tbkehadiran');
					}
				}
			}
			echo json_encode($result);
		} else {
			$result = 0;
			echo json_encode($result);
		}
	}

}
