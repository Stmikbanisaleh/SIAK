<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_potongan_guru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_masterpotongan_guru');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$myguru = $this->model_masterpotongan_guru->viewOrdering('tbguru', 'GuruNama', 'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/master_potongan_guru/view',
				'ribbon' 		=> '<li class="active">Master Potongan Guru</li>',
				'page_name' 	=> 'Master Potongan Guru',
				'js' 			=> 'js_file',
				'myguru'		=> $myguru
			);
			$this->render_view($data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil()
	{
		$my_data = $this->model_masterpotongan_guru->view_potongan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'IdGUru'  => $this->input->post('id_guru'),
				'infaq_masjid'  => $this->input->post('infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('anggota_koperasi_v'),
				'kas_bon' => $this->input->post('kas_bon_v'),
				'ijin_telat' => $this->input->post('ijin_telat_v'),
				'koperasi' => $this->input->post('koperasi_v'),
				'bmt' => $this->input->post('bmt_v'),
				'inval'  => $this->input->post('inval_v'),
				'toko' => $this->input->post('toko_v'),
				'lain' => $this->input->post('lain_v'),
				'tawun'  => $this->input->post('tawun_v'),
				'pph21'  => $this->input->post('pph21_v'),
				'ltq'  => $this->input->post('ltq_v'),
				'bpjs'  => $this->input->post('bpjs_v'),
				'ket_khusus1'  => $this->input->post('ket_khusus1'),
				'tunj_khusus1'  => $this->input->post('tunj_khusus1_v'),
			);
			$cek = $this->model_masterpotongan_guru->cek($data['IdGUru'])->num_rows();
			if ($cek > 0) {
				echo 401;
			} else {
				$result = $this->model_masterpotongan_guru->insert($data, 'tbgurupot');
				if ($result) {
					echo $result;
				}
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
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
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
						
						$arrayCustomerQuote = array(
							'IdGuru' => $value[0],
							'infaq_masjid' => $value[2],
							'anggota_koperasi' => $value[3],
							'kas_bon' => $value[4],
							'ijin_telat' => $value[5],
							'bmt' => $value[6],
							'koperasi' => $value[7],
							'inval' => $value[8],
							'toko' => $value[9],
							'tawun' => $value[10],
							'bpjs' => $value[11],
							'ltq' => $value[12],
							'ket_khusus1' => $value[13],
							'tunj_khusus1' => $value[14],
							'pph21' => 0,
						);

						$data_id = array(
							'IdGuru' => $value[0]
						);
						$cek = $this->model_masterpotongan_guru->view_count('tbgurupot',$value[0]);
						if($cek > 0 ){
							$result = $this->model_masterpotongan_guru->update($data_id, $arrayCustomerQuote, 'tbgurupot');
						} else {
							$result = $this->model_masterpotongan_guru->insert($arrayCustomerQuote, 'tbgurupot');
						}
						$result = 1;

					}
				}
			}
			echo json_encode($result);
		} else {
			$result = 0;
			echo json_encode($result);
		}
	}

	public function tampil_byid()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_potong'  => $this->input->post('id'),
			);
			$my_data = $this->model_masterpotongan_guru->view_where('tbgurupot', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function update()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_potong'  => $this->input->post('e_id_potong'),
			);
			$dataupdate = array(
				'infaq_masjid'  => $this->input->post('e_infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('e_anggota_koperasi_v'),
				'kas_bon'  => $this->input->post('e_kas_bon_v'),
				'ijin_telat'  => $this->input->post('e_ijin_telat_v'),
				'bmt'  => $this->input->post('e_bmt_v'),
				'koperasi'  => $this->input->post('e_koperasi_v'),
				'inval'  => $this->input->post('e_inval_v'),
				'tawun' => $this->input->post('e_tawun_v'),
				'toko'  => $this->input->post('e_toko_v'),
				'lain'  => $this->input->post('e_lain_v'),
				'pph21'  => $this->input->post('e_pph21_v'),
				'bpjs'  => $this->input->post('e_bpjs_v'),
				'ltq'  => $this->input->post('e_ltq_v'),
				'ket_khusus1'  => $this->input->post('e_ket_khusus1'),
				'tunj_khusus1'  => $this->input->post('e_tunj_khusus1_v'),
			);
			$my_data = $this->model_masterpotongan_guru->update($data, $dataupdate, 'tbgurupot');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function delete()
	{
		$data_id = array(
			'id_potong'  => $this->input->post('id')
		);
		$action = $this->model_masterpotongan_guru->delete($data_id, 'tbgurupot');
		if ($action) {
			echo json_encode($action);
		}
	}

	public function downloadsample()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$idtarif = $this->model_masterpotongan_guru->getformat()->result_array();
		$data = $idtarif;
		$no = 1;
		$row = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ID Guru');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Nama Guru');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Infaq Masjid');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Anggota Koperasi');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Kas Bon');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Ijin Telat');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'BMT / Pinjaman Koperasi');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Gemart');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Inval');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Toko Al Hamra');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Ta awun');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'BPJS');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'LTQ');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'Ket Pot Khusus 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'Pot Khusus 1');

				foreach ($data as $dataExcel) {
					
					$objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . $row, $dataExcel['IdGuru'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . $row, $dataExcel['GuruNama'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $row, $dataExcel['infaq_masjid'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $row, $dataExcel['anggota_koperasi'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $row, $dataExcel['kas_bon'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $row, $dataExcel['ijin_telat'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $row, $dataExcel['bmt'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $row, $dataExcel['koperasi'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('I' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $row, $dataExcel['inval'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('J' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $row, $dataExcel['toko'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('K' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('K' . $row, $dataExcel['tawun'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('L' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('L' . $row, $dataExcel['bpjs'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('M' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('M' . $row, $dataExcel['ltq'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('N' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('N' . $row, $dataExcel['ket_khusus1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('O' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O' . $row, $dataExcel['tunj_khusus1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);
					$row++;
					$no++;

				}
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=template_potongan_guru.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}
	}
}
