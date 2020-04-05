<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Impbayar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('kasir/model_imppembayaran');
		if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulkasir/dashboard/login');
        }
	}

	function render_view($data)
	{
		$this->template->load('templatekasir', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'page_content' 	=> '../pagekasir/impbayar/view',
				'ribbon' 		=> '<li class="active">Import Pembayaran</li><li>Sample</li>',
				'page_name' 	=> 'Import Pembayaran',
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function import()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
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

			foreach ($allDataInSheet as $ads) {
				if (array_filter($ads)) {
					array_push($data_exist, $ads);
				}
			}
			foreach ($data_exist as $key => $value) {
				if ($key == '0') {
					continue;
				} else {
					if ($value[0] == '') {
					} else {
						$arrayCustomerQuote = array(
							'NIS' => $value[0],
							'Noreg' => $value[1],
							'Kelas' => $value[3],
							'tglentri' => date("Y-m-d", strtotime($value[4])),
							'useridd' => $this->session->userdata('kodekaryawan'),
							'TotalBayar' => $value[9],
							'kodesekolah' => $value[5],
							// 'idtarif' => $value[8],
							'TA' => $value[7],
							'createdAt'	=> date('Y-m-d H:i:s')
						);
						$result = $this->model_imppembayaran->insert($arrayCustomerQuote, 'pembayaran_sekolah');
						$id = $this->db->insert_id();
						if ($id) {
							$arrayCustomerQuotedetail = array(
								'Nopembayaran' => $id,
								'kodejnsbayar' => $value[7],
								'idtarif' => $value[8],
								'nominalbayar' => $value[9],
								'createdAt'	=> date('Y-m-d H:i:s')
							);
							$result = $this->model_imppembayaran->insert($arrayCustomerQuotedetail, 'detail_bayar_sekolah');
						}
					}
				}
			}
			if ($result) {
				$result = 1;
			}
			echo json_encode($result);
		} else {
			$result = 0;
			echo json_encode($result);
		}
	}
}
